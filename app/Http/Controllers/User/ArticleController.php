<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Basket;
use Illuminate\Http\Request;

class ArticleController extends Controller{



    public function removeItemToBasket(Request $request){
        $data = $request->json()->all();

        $user = $request->user();

        $user_id = $user['id'];

        $article_id = $data['article_id'];
        $article_quantity = $data['quantity'];

        if(!$this->verifyArticle($article_id)){
            return response()->json([
                'error' => 'article not exist'
            ], 500);
        }


        $articles = Basket::where('user_id', $user_id)->get();

        foreach($articles as $article){

            if($article->article_id == $article_id){


                if($article->quantity > 1){
                    $newQuantity = $article->quantity - $article_quantity;

                    $article->update(['quantity' => $newQuantity ]);


                    return response()->json([
                        'response' => 'quantity update'
                    ], 200);
                }

                $article->delete();

                return response()->json([
                    'response' => 'article deleted'
                ], 200);


            }

        }

    }

    public function addItemToBasket(Request $request){
        $data = $request->json()->all();

        $user = $request->user();

        $user_id = $user['id'];

        $article_id = $data['article_id'];
        $article_quantity = $data['quantity'];

        if(!$this->verifyArticle($article_id)){
            return response()->json([
                'error' => 'article not exist'
            ], 500);
        }

        $articles = Basket::where('user_id', $user_id)->get();

        foreach($articles as $article){

            if($article->article_id == $article_id){

                $newQuantity = $article->quantity + $article_quantity;

                $article->update(['quantity' => $newQuantity ]);


                return response()->json([
                    'response' => 'quantity update'
                ], 200);
            }

        }


        Basket::create([
            'user_id' => $user_id,
            'article_id' => $article_id,
            'quantity' => $article_quantity
        ]);


        return response()->json([
            'response' => 'basket update'
        ], 200);
    }



    private function verifyArticle($article_id){
        $article = Article::where('id', $article_id)->first();


        if($article == null){
            return false;
        }

        return true;

    }

}
