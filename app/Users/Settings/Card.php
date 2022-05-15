<?php

namespace App\Users\Settings;

use App\Models\CardsUsers as CardsUsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Jlorente\CreditCards\CreditCardValidator;


class Card {


    private Request $request;

    public function __construct(Request $request){
        $this->request = $request;
    }



    public function add_card()
    {

        $user = $this->request->user();
        $user_id = $user['id'];
        $user_name = $user['username'];


        $cardInfo = $this->request->all();
        $cardNameOwner = $cardInfo['name'];
        $cardNumber = $cardInfo['number'];
        $cardExpiration = $cardInfo['expiration'];

        $expirationFormated = preg_split('[/]', $cardExpiration);

        $mouth = (int) $expirationFormated[0];
        $year = (int) $expirationFormated[1];

        $validator = new CreditCardValidator();


        if (!$validator->isValid($cardNumber)) {
            return response()->json([
                'error' => 'card number is not valid'
            ], 500);
        }

        $type = $validator->getType($cardNumber)->getType();


        if (!Card::dateIsValid($mouth, $year)) {
            return response()->json([
                'error' => 'date is not valid'
            ], 500);
        }

        CardsUsersModel::create_card($user_id, $cardNameOwner, $cardNumber, $cardExpiration);


        return response()->json([
            "success" => "card created"
        ], 200);


    }


    public function get_cards(){

        $user = $this->request->user();

        $user_id = $user['id'];

        $cards = CardsUsersModel::get_cards($user_id);

        foreach($cards as $card){

            $card_number = $card['card_number'];
            $card_owner = $card['owner_name'];
            $card_expiration = $card['expiration'];



            $card_number_split = str_split($card_number, 4);

            $card_number_split = [$card_number_split[0], '****', '****', $card_number_split[3]];

            $card_format = implode(" ", $card_number_split);


            return response()->json([
                "owner_name" => $card_owner,
                "card_number" => $card_format,
                "card_expiration" => $card_expiration
            ], 200);

        }

    }

    public function remove_card(){
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


        $cards = CardsUsersModel::where('user_id', $user_id)->get();


        if($cards == null){
            return response()->json([
                'error' => 'Unknown error'
            ], 500);
        }

        CardsUsersModel::where('id', $data_card_id)->delete();


        return response()->json([
            "response" => "data is delete"
        ]);
    }

    private function dateIsValid($mouth_card, $year_card) {

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
}
