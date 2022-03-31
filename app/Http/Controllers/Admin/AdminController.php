<?php

namespace App\Http\Controllers\Admin;

// use App\Article;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        return null;
    }

    public function createArticle(Request $request)
    {

        $user = $request->user();
        $user_rank = (int) $user['rank'];

        if ($user_rank < 1) {

            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        $content = $request->json()->all();

        $genre_id = $content['genre_id'];
        $name = $content['name'];
        $description = $content['description'];
        $price = $content['price'];
        $stock = $content['stock'];
        $production = $content['production'];
        $brand = $content['brand'];

        $article = Article::where('name', $name)->first();
        $article2 = Article::where('brand', $brand)->first();


        if (!$article || !$article2) {
            Article::create([
                'genre_id' => intval($genre_id),
                'name' => $name,
                'description' => $description,
                'price' => doubleval($price),
                'stock' => intval($stock),
                'production' => intval($production),
                'brand' => $brand
            ]);

            return response()->json([
                'result' => 'article added in db'
            ], 200);
        }


        return response()->json([
            'error' => 'article adrealy exist'
        ], 200);
    }
}
