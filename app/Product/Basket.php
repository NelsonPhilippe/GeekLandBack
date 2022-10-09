<?

namespace App\Product;

use App\Models\Article;
use App\Models\Basket as ModelsBasket;
use Illuminate\Http\Request;

class Basket {

    private Request $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function remove_item_to_basket(){

        $data = $this->request->json()->all();

        $user = $this->request->user();
        $user_id = $user['id'];

        $article_id = $data['article_id'];
        $article_quantity = $data['quantity'];

        if(!$this->verifyArticle($article_id)){
            return response()->json([
                'error' => 'article not exist'
            ], 500);
        }


        $articles = ModelsBasket::where('user_id', $user_id)->get();

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

    public function add_item_to_basket(){

        $data = $this->request->json()->all();

        $user = $this->request->user();

        $user_id = $user['id'];

        $article_id = $data['article_id'];
        $article_quantity = $data['quantity'];

        if(!$this->verifyArticle($article_id)){
            return response()->json([
                'error' => 'article not exist'
            ], 500);
        }

        $articles = ModelsBasket::where('user_id', $user_id)->get();

        foreach($articles as $article){

            if($article->article_id == $article_id){

                $newQuantity = $article->quantity + $article_quantity;

                $article->update(['quantity' => $newQuantity ]);


                return response()->json([
                    'response' => 'quantity update'
                ], 200);
            }

        }


        ModelsBasket::create([
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
