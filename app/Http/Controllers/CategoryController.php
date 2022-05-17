<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\IntiController;
use App\Models\Category;


class CategoryController extends Controller
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

        $a->info['page_titel'] = 'categories';
        $a->info['page_hover'] = 'categories';

        return $a->info ;
    }

    public function index($mode = '') // this mode to specifiy return mode => {view || redirct }
    {
        //
        $data = $this->sendData();
        
        $Category = new Category();

        $rows = $Category->all();
        $data['rows'] = $rows;

        foreach($data['rows'] as $row){
            $countPost[$row->id] = $Category->find($row->id)->countPosts();
        }
        if(isset($countPost)){
            $data['countPost'] = $countPost;
        }

        return $mode == '' ? view('admin.categories.categories',$data) : redirect()->route('categories.index') ;
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
        $data['page_titel'] = 'add category';

        return view('admin.categories.add_category', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //

        $valedated = $req->validate([
            'name' => 'required | string'
        ]);

        $date = date('Y-m-d H:i:s');

        Category::insert([
            'name' => $req->input('name'),
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        return $this->index('route');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = $this->sendData();

        $data['page_titel'] = 'edit category';

        $row = Category::find($id);

        $data['row'] = $row;

        return view('admin.categories.edit_category',$data);
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
        //
        $valedated = $req->validate([
            'name' => 'required | string'
        ]);

        $date = date('Y-m-d H:i:s');

        Category::where('id',$id)->update([
            'name' => $req->input('name'),
            'updated_at' => $date,
        ]);

        return $this->index('route');
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

        
        $posts = DB::select('select image from posts where category_id = ?', [$id]);
        

        foreach($posts as $post) {
            if(file_exists('uploads/'.$post->image)){
                unlink('uploads/'.$post->image);
            }
            
            DB::delete('delete from posts where category_id = ?', [$id]);
            
        }

        Category::find($id)->delete();

        return redirect()->route('categories.index');
    }
}
