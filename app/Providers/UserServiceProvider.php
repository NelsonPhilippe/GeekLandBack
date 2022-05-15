<?php

namespace App\Providers;

use App\Users\Settings\Card;
use App\Users\Settings\Profile;
use App\Users\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider{


    public function register(){

        $this->app->singleton("user", function(){
            $request = app(\Illuminate\Http\Request::class);

            return app(User::class, [$request]);
        });

        $this->app->singleton("card", function() {

            $request = app(\Illuminate\Http\Request::class);
            return app(Card::class, [$request]);
        });

        $this->app->singleton("profile", function() {

            $request = app(\Illuminate\Http\Request::class);
            return app(Profile::class, [$request]);
        });
    }

}
