<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\IntiController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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

        $a->info['page_titel'] = 'users';
        $a->info['page_hover'] = 'users';

        return $a->info ;
    }
    
    public function index($mode = '')
    {
        //
        $data = $this->sendData();

        $rows = User::all();
        
        $data['rows'] = $rows;

        return $mode == '' ? view('admin.users.users',$data) : redirect()->route('users.index') ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $data['page_titel'] = 'edit my profile';
        $data['page_hover'] = 'edit profile';

        $row = User::find($id);

        $data['row'] = $row;

        return view('admin.users.edit_user',$data);
        
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
            'name' => 'required | string',
            'email' => 'required | email '
        ]);

        $date = date('Y-m-d H:i:s');

        if(! empty($req->input('password'))){

            $data['password'] = Hash::make($req->input('password'));
        }
        $data['name'] = $req->input('name');
        $data['email'] = $req->input('email');

        User::where('id',$id)->update($data);

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
    }
}
