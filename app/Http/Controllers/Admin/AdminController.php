<?php

namespace App\Http\Controllers\admin;

// use App\Article;

use App\Models\Article;
use App\Http\Controllers\Controller;

class AdminController extends Controller{


    public function __construct(){
    }

    public function index(){
        return null;
    }

    public function article(){
        $content = request()->json()->all();

        $genre_id = $content['genre_id'];
        $name = $content['name'];
        $description = $content['description'];
        $price = $content['price'];
        $stock = $content['stock'];
        $production = $content['production'];
        $brand = $content['brand'];

        $article = Article::exists($name);
        $article2 = Article::exists($brand);


        if(!$article || !$article2){
            Article::create([
                'genre_id' => intval($genre_id),
                'name' => $name,
                'description' => $description,
                'price' => doubleval($price),
                'stock' => intval($stock),
                'production' => intval($production),
                'brand' => $brand
            ]);

            return response('ok', 200);

        }


        // return $article2;
        return response('ok', 400);
    }

}
