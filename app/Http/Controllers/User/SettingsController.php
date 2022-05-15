<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Users\Settings\Card;
use Illuminate\Http\Request;

class SettingsController extends Controller
{


    public function index()
    {
    }


    public function information() {
    }

    public function profile(Request $request) {
        return response($request->user());
    }

    public function removeCard(Request $request){
        $user = $request->user();

        $user_id = $user['id'];

        $data = $request->json()->all();

        $data_user_id = $data['user_id'];
        $data_card_id = $data['card_id'];

        if($data_user_id != $user_id){

            return response()->json([
                'error' => 'Unknown error'
            ], 500);
        }


        $cards = CardsUsers::where('user_id', $user_id)->get();


        if($cards == null){
            return response()->json([
                'error' => 'Unknown error'
            ], 500);
        }

        CardsUsers::where('id', $data_card_id)->delete();


        return response()->json([
            "response" => "data is delete"
        ]);

    }

    public function addCard(Card $card)
    {
        return $card->add_card();
    }

    public function get_card(Card $card){
        return $card->get_cards();
    }


    // public function setProfilePicture(Request $request){
    //     $data = $request->json()->all();

    //     $user_id = $request->user()['id'];
    //     $uuid_pictures = $data['picture_uuid'];


    // }


}
