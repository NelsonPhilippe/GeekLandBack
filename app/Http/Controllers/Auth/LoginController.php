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
        $this->middleware('auth:api', ['except' => ['authenticate', 'register', 'profile']]);
        // $this->user = $this->guard()->user();
    }


    public function authenticate(Request $request){
        $credentials = $request->json()->all();

        $mail = $credentials['email'];
        $password = $credentials['password'];

        if($token = Auth::attempt(['email' => $mail, 'password' => $password])){
            return $this->createNewToken($token);
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

    public function profile(){
        return response()->json(auth()->user());
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
