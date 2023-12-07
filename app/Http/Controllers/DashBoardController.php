<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index(){
        return view('dashboard.layout');
    }

    public function chat(){
        return view('dashboard.chat');
    }

}
