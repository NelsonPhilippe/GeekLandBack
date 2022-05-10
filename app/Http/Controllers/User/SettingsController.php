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


        // $user = $request->user();
        // $user_id = $user['id'];


        // $cardInfo = $request->json()->all();
        // $cardNameOwner = $cardInfo['name'];
        // $cardNumber = $cardInfo['number'];
        // $cardExpiration = $cardInfo['expiration'];

        // $expirationFormated = preg_split('[/]', $cardExpiration);

        // $mouth = (int) $expirationFormated[0];
        // $year = (int) $expirationFormated[1];

        // $validator = new CreditCardValidator();



        // if ($validator->isValid($cardNumber)) {

        //     $type = $validator->getType($cardNumber)->getType();


        //     if ($this->dateIsValid($mouth, $year)) {


        //         $cards = CardsUsers::where('user_id', $user_id)->get();


        //         foreach ($cards as $card) {

        //             if (Hash::check($cardNumber, $card->card_number)) {

        //                 return response()->json([
        //                     'error' => 'card adrealy exist'
        //                 ], 500);

        //             }
        //         }

        //         CardsUsers::create([
        //             "user_id" => $user_id,
        //             "owner_name" => $cardNameOwner,
        //             "card_number" => Hash::make($cardNumber),
        //             "expiration" => $cardExpiration
        //         ]);

        //         return response()->json([
        //             "response" => "ok",
        //             "type-card" => $type
        //         ], 200);

        //     }


        //     return response()->json([
        //         'error' => 'date is not valide'
        //     ], 200);
        // }

        // return response()->json([
        //     'error' => 'unknow type of card'
        // ], 500);
    }

    private function dateIsValid($mouth_card, $year_card)
    {

        $mouth = (int) date('m');
        $year = (int) date('y');


        if ($mouth_card >= $mouth && $year_card >= $year) {
            return true;
        }

        if (
            $year_card > $year
        ) {
            return true;
        }

        return false;
    }


    // public function setProfilePicture(Request $request){
    //     $data = $request->json()->all();

    //     $user_id = $request->user()['id'];
    //     $uuid_pictures = $data['picture_uuid'];


    // }


}
