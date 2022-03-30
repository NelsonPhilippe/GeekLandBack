<?php

namespace App\Http\Controllers;


class ArticleController extends Controller{
    public function removeItemToBasket(Request $request){

    }

    public function addItemToBasket(Request $request){
        $data = $request->json()->all();

        $user = $request->user();

        $user_id = $user['id'];

        $article_id = $data['article_id'];
        $article_quantity = $data['quantity'];

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



    private function verifyArticle(){

    }

}
