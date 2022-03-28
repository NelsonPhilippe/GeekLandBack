<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
        $email = $credentials['mail'];
        $password = $credentials['password'];
        $newsletter = $credentials['newsletter'];

        $passwordEncrypted = Hash::make($password);


        $user = User::where('email', $email)->first();

        if($user == null){
            $user = User::create([
                'username' => $username,
                'email' => $email,
                'password' => $passwordEncrypted,
                'newsletters' => $newsletter,
                'rank' => 1,
                'remember_token' => 'is a none value'
            ]);

            $token = $user->createToken('testtoken')->plainTextToken;

            return response(200)->json([
               'reponse' => 'ok',
               'token' => $token
            ]);
        }


        return response('user exist', 500);

    }


}
