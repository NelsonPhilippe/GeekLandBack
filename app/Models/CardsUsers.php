<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardsUsers extends Model{

    protected $fillable = ['user_id', 'owner_name', 'card_number', 'expiration'];

    protected $guard = ['user_id', 'owner_name', 'card_number', 'expiration'];

}
