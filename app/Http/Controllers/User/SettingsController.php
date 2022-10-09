<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Users\Settings\Card;
use App\Users\Settings\Profile;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function profile(Profile $profile) {
        return $profile->get_profile();
    }

    public function remove_card(Card $card){
        return $card->remove_card();
    }

    public function add_card(Card $card){
        return $card->add_card();
    }

    public function get_card(Card $card){
        return $card->get_cards();
    }


}
