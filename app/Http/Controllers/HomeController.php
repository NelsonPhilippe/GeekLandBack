<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product\Articles;

class HomeController extends Controller{

    public function __construct(){
    }

    public function index(Articles $article){
        return $article->get();
    }

}

