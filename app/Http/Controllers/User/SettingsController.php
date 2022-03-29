<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CardsUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jlorente\CreditCards\CreditCardValidator;

class SettingsController extends Controller{


    public function index(){

    }


    public function information(){


    }

    public function profile(Request $request){
        return response($request->user());
    }

    public function addCard(Request $request){
        $user = $request->user();
        $user_id = $user['id'];

        $cardInfo = $request->json()->all();
        $cardNameOwner = $cardInfo['name'];
        $cardNumber = $cardInfo['number'];
        $cardExpiration = $cardInfo['expiration'];

        $expirationFormated = preg_split('[/]', $cardExpiration);

        $mouth = (int) $expirationFormated[0];
        $year = (int) $expirationFormated[1];

        $validator = new CreditCardValidator();



        if($validator->isValid($cardNumber)){

            $type = $validator->getType($cardNumber)->getType();


            if($this->dateIsValid($mouth, $year)){
                CardsUsers::create([
                    "user_id" => $user_id,
                    "owner_name" => $cardNameOwner,
                    "card_number" => $cardNumber,
                    "expiration" => $cardExpiration
                ]);
            }


            $card = CardsUsers::where('user_id', $user_id);


            foreach($card as $user_card){

            }



            return response()->json([
                'type-card' => $type,
                'expiration-valid' => $this->dateIsValid($mouth, $year)
            ], 200);

        }

        return response()->json([
            'error' => 'unknow type of card'
        ], 500);

    }

    private function dateIsValid($mouth_card, $year_card){

        $mouth = (int) date('m');
        $year = (int) date('y');


        if($mouth_card >= $mouth && $year_card >= $year){
            return true;
        }

        if($year_card > $year
        ){
            return true;
        }

        return false;

    }

}
