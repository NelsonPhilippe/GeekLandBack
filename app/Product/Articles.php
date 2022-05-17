<?php

namespace App\Product;

use App\Models\Article;

class Articles{

    public function get()
    {

         $articles = Article::all();
         return response()->json($articles);
    }

    public function get_article_with_name(){
        $data = $this->request->json()->all();


        $articles = Article::where('name',
        'like', '%'.$data['name'].'%',
        'OR', 'description', 'like', '%'.$data['name'].'%')->get();

        if(count(array($articles)) < 1){
            return response()->json([
                'status' => 'error',
                'error' => 'not match name or description'
            ], 200);
        }


        return response()->json([
            'status' => 'success',
            'articles' => $articles
        ], 200);

    }

}
