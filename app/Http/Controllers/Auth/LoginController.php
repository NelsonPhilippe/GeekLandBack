<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function authenticate(Request $request){
        $credentials = $request->json()->all();

        $mail = $credentials['email'];
        $password = $credentials['password'];

        $user = User::where('email', $mail)->first();


        if($user != null){
            if(Hash::check($password, $user->password)){
                $token = $user->createToken('myapptoken')->plainTextToken;
                return $token;
            }
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request){
        $credentials = $request->json()->all();



        $username = $credentials['username'];
        $email = $credentials['email'];
        $password = $credentials['password'];
        $name = $credentials['name'];
        $last_name = $credentials['last_name'];
        $postal_adress= $credentials['postal_adress'];
        $postal_code = $credentials['postal_code'];
        $city = $credentials['city'];
        $country = $credentials['country'];
        $phone = $credentials['phone'];
        $newsletter = $credentials['newsletter'];
        $url = $credentials['url_image_profile'];

        $passwordEncrypted = Hash::make($password);


        $user = User::where('email', $email)->first();

        if($user == null){
            $user = User::create([
                'username' => $username,
                'mail' => $email,
                'password' => $passwordEncrypted,
                'name' => $name,
                'last_name' => $last_name,
                'postal_adress' => $postal_adress,
                'postal_code' => $postal_code,
                'city' => $city,
                'country' => $country,
                'phone' => $phone,
                'newsletters' => $newsletter,
                'rank' => 0,
                'remember_token' => 'is a none value',
                'url_image_profile' => $url
            ]);

            $token = $user->createToken(App::environment('JWT_SECRET'))->plainTextToken;


            return response()->json([
               'reponse' => 'ok',
               'token' => $token
            ], 200);
        }


        return response()->json([
            'response' => 'user exist'
        ], 200);

    }


}
