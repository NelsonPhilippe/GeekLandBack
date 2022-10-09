<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Product\Articles;
use App\Product\Basket;
use Illuminate\Http\Request;

class ArticleController extends Controller{



    public function removeItemToBasket(Basket $basket){
        return $basket->remove_item_to_basket();
    }

    public function addItemToBasket(Basket $basket): \Illuminate\Http\JsonResponse
    {
        return $basket->add_item_to_basket();
    }



    public function getArticlesWithName(Articles $article): \Illuminate\Http\JsonResponse
    {
        return $article->get_article_with_name();
    }

}
