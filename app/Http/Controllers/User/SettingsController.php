<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CardsUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Jlorente\CreditCards\CreditCardValidator;

class SettingsController extends Controller
{


    public function index()
    {
    }


    public function information()
    {
    }

    public function profile(Request $request)
    {
        return response($request->user());
    }

    public function addCard(Request $request)
    {
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



        if ($validator->isValid($cardNumber)) {

            $type = $validator->getType($cardNumber)->getType();


            if ($this->dateIsValid($mouth, $year)) {


                $cards = CardsUsers::where('user_id', $user_id)->get();



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

                return response(200)->json([
                    "response" => "ok"
                ]);

            }


            return response(500)->json([
                'error' => 'date is not valide'
            ], 200);
        }

        return response(500)->json([
            'error' => 'unknow type of card'
        ], 500);
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
}
