<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CardsUsers extends Model{

    protected $fillable = ['user_id', 'owner_name', 'card_number', 'expiration'];

    protected $guard = ['user_id', 'owner_name', 'card_number', 'expiration'];

    public static function create_card($user_id, $owner_name, $cardNumber, $cardExpiration){
        CardsUsers::create([
            "user_id" => $user_id,
            "owner_name" => $owner_name,
            "card_number" => Hash::make($cardNumber),
            "expiration" => $cardExpiration
        ]);
    }

}
