<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Product\Articles;
use App\Product\Basket;
use Illuminate\Http\Request;

class ArticleController extends Controller{



    public function removeItemToBasket(Basket $basket){
        $basket->remove_item_to_basket();
    }

    public function addItemToBasket(Basket $basket){
        $basket->add_item_to_basket();
    }



    public function getArticlesWithName(Articles $article){
        $article->get_article_with_name();
    }

}
