<?php

namespace App\Users;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class User extends ServiceProvider{

    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function get_user(){
        $user = $this->request->user();

        return $user;

    }

}
