<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class SingleController extends Controller
{
    public function index($slag) {

        $rowPost = DB::table('posts')
        ->join('categories','posts.category_id', '=' , 'categories.id')
        ->where('posts.slag',$slag)
        ->select('posts.*','categories.name')
        ->get();
    
        $rowsCategories = Category::all();

        if($rowPost){
            $rowPost = $rowPost[0]; 
            $data['rowPost'] = $rowPost;
        }
        
        $data['rowsCategories'] = $rowsCategories;
        
        return view('single',$data);
    }

}
