<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Users\User;

class LoginController extends Controller {

    public function authenticate(User $user){
        return $user->register_user();
    }

    public function register(User $user){

        return $user->create_user();
    }

    public function removeAccount(User $user){
        return $user->remove_user();
    }


}
