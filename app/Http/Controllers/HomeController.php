<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller{

    public function __construct(){
        // $this->middleware('ip');
    }

    public function index(\App\Product\Articles $article){
        return $article->get();
    }

}

