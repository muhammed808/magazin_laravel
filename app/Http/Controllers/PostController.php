<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\IntiController;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendData()  // this function to send the same data to all function  
    {
        # code...
        $a = new IntiController();

        $a->info['page_titel'] = 'posts';
        $a->info['page_hover'] = 'posts';

        return $a->info ;
    }

    public function decodeContentImg( $req)
    {

        preg_match_all('/<img src="data[^>]+>/',$req->input('content'),$matches);

        $newContent = $req->input('content');

        if(is_array($matches) && count($matches) > 0){

            $folder = 'uploads/';

            if(! file_exists($folder)){

                mkdir($folder,0777,true);
            }   

            $matches = $matches[0];

            foreach($matches as $match){

                preg_match('/src="[^"]+/',$match,$matches2);

                $part = explode(",",$matches2[0]);

                preg_match('/src="[^;]+/',$part[0] , $extention);


                $extentionImg = explode("/",$extention[0]); 

                $filename = $folder . "based_64_" . rand(1,5000000000) . $extentionImg[1];

                
                $newContent = str_replace($matches2[0],'src="'.url($filename),$newContent);
                
                file_put_contents($filename , base64_decode($part[1]));
            }
        }
        return $newContent ;
    }

    public function index($mode = '') // this mode to specifiy return mode => {view || redirct }
    {
        //

        $data = $this->sendData();
        $rows = Post::join('categories','posts.category_id','=','categories.id')
                        ->join('users','posts.user_id','=','users.id')
                    ->select('posts.*','categories.name','users.name as user_name')
                    ->paginate(10);

        

        $data['rows'] = $rows;

        return $mode == '' ? view('admin.posts.posts',$data) : redirect()->route('posts.index') ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = $this->sendData();
        $data['page_titel'] = 'add post';

        $categories = DB::select('select name , id from categories');
        $data['categories'] = $categories;

        return view('admin.posts.add_post', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $validation = new IntiController();

        $validation->validationStore($req);
        
        $newContent = $this->decodeContentImg($req);
        
        $path = $req->file('image')->store('/',['disk' => 'my_disk']); 

        $date = date('Y-m-d H:i:s');

        $post = new Post();

        $title =  $req->input('title');

        $userId = Auth::id();

        $post->insert([
            'title'         => $title,
            'category_id'   => $req->input('category_id'),
            'user_id'       => $userId,
            'content'       => $newContent,
            'image'         => $path,
            'slag'          => Str::slug($title),
            'created_at'    => $date,
            'updated_at'    => $date
        ]);

        return $this->index('route');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req , $id)
    {
        //
        $data = $this->sendData();
        
            $title = '%'. $req->input('find') . "%";

            $rows = Post::join('categories' , 'posts.category_id' , '=' , 'categories.id')
                        ->join('users','posts.user_id','=','users.id')
                        ->where('title' , 'like' , $title)
                        ->select('posts.*' , 'categories.name' , 'users.name as user_name')
                        ->paginate(PAGINATION)->withQueryString();
            $data['rows'] = $rows;

            return view('admin.posts.posts',$data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->sendData();

        $data['page_titel'] = 'edit post';

        $row = Post::find($id);

        $data['row'] = $row;

        $categories = DB::select('select name , id from categories');

        $data['categories'] = $categories;

        return view('admin.posts.edit_post',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $validation = new IntiController();

        $validation->validationUpdate($req);

        Post::where('id' , $id)->update(['content' => 'NULL']);
        
        $newContent = $this->decodeContentImg($req);

        $date = date('Y-m-d H:i:s');

        if($req->file('image')){
            $query['image'] = $this->updatePostImg($req,$id);
        }

        $post = new Post();

        $title = $req->input('title');
        $userId = Auth::id();


        $query['title']         = $title ;
        $query['user_id']       = $userId ;
        $query['category_id']   = $req->input('category_id');
        $query['content']       = $newContent;
        $query['slag']          = Str::slug($title);
        $query['updated_at']    = $date;

        $post->where('id' , $id)->update($query);

        return $this->index('route');
    }

    public function updatePostImg($req , $id)
    {
        $oldRows = Post::find($id);

        if(file_exists('uploads/'.$oldRows->image)){
            unlink('uploads/'.$oldRows->image);
        }
        $path = $req->file('image')->store('/',['disk' => 'my_disk']);
        return $path;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->destroyPostImages($id);

        Post::find($id)->delete();

        return redirect()->route('posts.index');
    }

    public function destroyPostImages($id)
    {
        $contentImages = Post::find($id)->content;

        preg_match_all('/<img src="[^>]+>/',$contentImages,$matches);
        preg_match_all('/based_64[^"]+/',$contentImages,$matches2);

        $matches2 = $matches2[0];

        foreach($matches2 as $match){
            if(file_exists('uploads/'.$match)){
                unlink('uploads/'.$match);
            }
        }

        $path = Post::find($id)->image;

        if(file_exists('uploads/'.$path)){
            unlink('uploads/'.$path);
        }
    }
}
