<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\Request;


class SettingsController extends Controller{


    public function index(){

    }


    public function information(){


    }

    public function profile(Request $request){
        return response($request->user());
    }

    public function addCard(Request $request){
        $user = $request->user();
        $user_id = $user['id'];

        $cardInfo = $request->json()->all();

        $request->validate([

        ]);


    }

}
