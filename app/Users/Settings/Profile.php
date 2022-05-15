<?php

namespace App\Users\Settings;


use Illuminate\Http\Request;
use App\Models\User;

class Profile {

    private Request $request;

    public function __construct(Request $request){
        $this->request = $request;
    }



    public function get_profile(){

        $user = $this->request->user();
        $user_id = $user['id'];


        $profile = User::where('id', $user_id)->first();


        $username = $profile['username'];
        $name = $profile['name'];
        $last_name = $profile['lastname'];
        $email = $profile['email'];
        $postal_address = $profile['postal_adress'];
        $postal_code = $profile['postal_code'];
        $city = $profile['city'];
        $country = $profile['country'];
        $phone = $profile['phone'];
        $newsletter = $profile['newsletters'];


        return response()->json([
            'username' => $username,
            'name' => $name,
            'last_name' => $last_name,
            'email' => $email,
            'postal_address' => $postal_address,
            'postal_code' => $postal_code,
            'city' => $city,
            'country' => $country,
            'phone' => $phone,
            'newsletter' => $newsletter
        ], 200);

    }

}
