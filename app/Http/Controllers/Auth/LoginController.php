<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('guest')->except('logout');
    }


    public function authenticate(Request $request){
        $credentials = $request->json()->all();

        $mail = $credentials['email'];
        $password = $credentials['password'];

        if(Auth::attempt(['email' => $mail, 'password' => $password])){
            return response("success", 200);
        }
    }

    public function register(Request $request){
        $credentials = $request->json()->all();


        $username = $credentials['username'];
        $email = $credentials['mail'];
        $password = $credentials['password'];
        $newsletter = $credentials['newsletter'];

        $passwordEncrypted = Hash::make($password);

        User::create([
            'username' => $username,
            'email' => $email,
            'password' => $passwordEncrypted,
            'newsletters' => $newsletter,
            'rank' => 1,
            'remember_token' => 'is a none value'
        ]);


        return response('ok', 200);



    }
}
