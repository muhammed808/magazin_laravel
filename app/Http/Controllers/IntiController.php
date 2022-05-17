<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntiController extends Controller
{
    public $info = array();

    public function validationStore(Request $req)
    {
        $validated = $req->validate([
                    'title' => 'required|string',
                    'image' => 'required|image',
                    'category_id' => 'required | numeric | gt:0',
                    'content' => 'required'
                    ]);
        
        return $validated;
    }

    public function validationUpdate(Request $req)
    {
        $validated = $req->validate([
            'title' => 'required|string',
            'image' => 'image',
            'category_id' => 'required | numeric | gt:0',
            'content' => 'required'
        ]);
        return $validated;
    }
}
