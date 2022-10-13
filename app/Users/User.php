<?php

namespace App\Users;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class User {

    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function get_user(){
        $user = $this->request->user();

        return $user;

    }

    public function create_user(){

        $credentials = $this->request->json()->all();



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


        $user = UserModel::where('email', $email)->first();

        if($user == null){
            $user = UserModel::create([
                'username' => $username,
                'email' => $email,
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

            $token = $user->createToken(env('JWT_SECRET'))->plainTextToken;


            return response()->json([
               'status' => 'success',
               'token' => $token
            ], 200);
        }


        return response()->json([
            'status' => 'error',
            'error' => 'user exist'
        ], 200);

    }

    public function remove_user(){
        $user = $this->request->user();


        User::where('id', '=', $user['id'])->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function register_user(){
        $credentials = $this->request->json()->all();

        $mail = $credentials['email'];
        $password = $credentials['password'];

        $user = UserModel::where('email', $mail)->first();


        if($user != null){
            if(Hash::check($password, $user->password)){
                $token = $user->createToken(env('JWT_SECRET'))->plainTextToken;
                return response()->json([
                    'status' => 'success',
                    'token' => $token
                ], 200);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

}
