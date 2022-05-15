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

    public static function get_cards($user_id){
        return CardsUsers::where('user_id', $user_id)->get();
    }

    public static function remove_card($card_id){
        CardsUsers::where('id', $card_id)->delete();
    }

}
