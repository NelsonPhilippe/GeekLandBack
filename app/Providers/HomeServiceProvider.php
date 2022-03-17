<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Product\Articles;
use Illuminate\Support\Facades\Response;

class HomeServiceProvider extends ServiceProvider{


    public function register(){
        $this->app->singleton('article', function(){
            return new Articles();
        });
    }

}
