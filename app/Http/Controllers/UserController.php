<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('user-list');
    }
    public function createUser()
    {
        return view('create-user-list');
    }
}
