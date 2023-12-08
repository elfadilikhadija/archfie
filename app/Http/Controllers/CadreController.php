<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadreController extends Controller
{
    public function index(){
        return view('cadre.home');
    }
    
}
