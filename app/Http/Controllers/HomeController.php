<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $req) {

        if($req->input('find')){
        
            $title = '%'. $req->input('find') . "%";

            $rows = Post::join('categories' , 'posts.category_id' , '=' , 'categories.id')
                        ->join('users','posts.user_id','=','users.id')
                        ->where('title' , 'like' , $title)
                        ->select('posts.*' , 'categories.name','users.name as user_name')
                        ->paginate(PAGINATION)->withQueryString();

        }elseif($req->input('cate')){
        
            $id =  $req->input('cate') ;

            $rows = Post::join('categories' , 'posts.category_id' , '=' , 'categories.id')
                        ->join('users','posts.user_id','=','users.id')
                        ->where('posts.category_id' , $id)
                        ->select('posts.*' , 'categories.name','users.name as user_name')
                        ->paginate(PAGINATION)->withQueryString();
        }else{

            $rows = Post::join('categories' , 'posts.category_id' , '=' , 'categories.id')
                        ->join('users','posts.user_id','=','users.id')
            ->select('posts.*' , 'categories.name','users.name as user_name')
            ->orderBy('posts.category_id')
            ->paginate(PAGINATION);
        }

        $rowsCategories = Category::all();


        $data['rows'] = $rows;

        $data['rowsCategories'] = $rowsCategories;

        return view('index', $data);
    }
}
