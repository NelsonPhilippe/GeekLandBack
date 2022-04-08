<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PurchaseHistory;
use Illuminate\Http\Request;

class HistoryController extends Controller{


    public function getArticle(Request $request){
        $user = $request->user();

        $user_id = $user['id'];

        $articles = PurchaseHistory::where('user_id', $user_id)->get();


        return response()->json($articles, 200);

    }


    public function addArticle(){

        $data = $request->json()->all();

        $user = $request->user();

        $user_id = $user['id'];
        $article_id = $data['article_id'];
        $delivery_type = $data['delivery_type'];
        $price = $data['price'];

        PurchaseHistory::create([
            'user_id' => $user_id,
            'article_id' => $article_id,
            'delivery_type' => $delivery_type,
            'price' => $price
        ]);


        return response()->json([
            'response' => 'purchase added'
        ], 200);
    }


}
