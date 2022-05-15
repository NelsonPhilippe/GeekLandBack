<?php

namespace App\Users\Settings;

use App\Models\CardsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Jlorente\CreditCards\CreditCardValidator;


class Card extends ServiceProvider

{


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

        CardsUsers::create_card($user_id, $cardNameOwner, $cardNumber, $cardExpiration);


        return response()->json([
            "success" => "card created"
        ], 200);


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


    public function get_cards(){

        $user = $this->request->user();

        $user_id = $user['id'];

        $card = CardsUsers::get_cards($user_id);

        $card_number_hashed = $card['card_number'];


        return response();




    }

    public function addCard(){
        $user = $this->request->user();
        $user_id = $user['id'];


        $cardInfo = $this->request->json()->all();
        $cardNameOwner = $cardInfo['name'];
        $cardNumber = $cardInfo['number'];
        $cardExpiration = $cardInfo['expiration'];

        $expirationFormated = preg_split('[/]', $cardExpiration);

        $mouth = (int) $expirationFormated[0];
        $year = (int) $expirationFormated[1];

        $validator = new CreditCardValidator();



        if ($validator->isValid($cardNumber)) {

            $type = $validator->getType($cardNumber)->getType();


            if (Card::dateIsValid($mouth, $year)) {


                $cards = CardsUsers::get_card($user_id);


                foreach ($cards as $card) {

                    if (Hash::check($cardNumber, $card->card_number)) {

                        return response()->json([
                            'error' => 'card adrealy exist'
                        ], 500);

                    }
                }

                CardsUsers::create([
                    "user_id" => $user_id,
                    "owner_name" => $cardNameOwner,
                    "card_number" => Hash::make($cardNumber),
                    "expiration" => $cardExpiration
                ]);

                return response()->json([
                    "response" => "ok",
                    "type-card" => $type
                ], 200);

            }


            return response()->json([
                'error' => 'date is not valide'
            ], 200);
        }

        return response()->json([
            'error' => 'unknow type of card'
        ], 500);
    }
}
