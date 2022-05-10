<?php

namespace App\Providers;

use App\Users\Settings\Card;
use App\Users\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider{


    public function register(){

        $this->app->singleton("user", function(){
            $request = app(\Illuminate\Http\Request::class);

            return new User($request);
        });

        $this->app->singleton("card", function() {

            $request = app(\Illuminate\Http\Request::class);
            return app(Card::class, [$request]);
        });
    }

}
