<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function mainPage(){
        return view('welcome');
    }
}
