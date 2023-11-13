<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SgController extends Controller
{
    public function index(){
        return view('sg.home');
    }
}
