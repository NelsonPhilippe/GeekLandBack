<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{

    protected $fillable = [
        'id', 'user_id', 'article_id', 'quantity'
    ];

    protected $guarded = [ 'id', 'user_id', 'article_id', 'quantity'];
}
