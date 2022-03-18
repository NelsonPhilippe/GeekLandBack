<?php

namespace App\Product;

use App\Models\Article;

class Articles{

    public function get()
    {

         $articles = Article::all();
         return response()->json($articles);
    }



}
