<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    
    public function index()
    {
        $data['page_titel'] = 'dashboard';
        $data['page_hover'] = 'dashboard';

        return view('admin.admin',$data);
    }
}
