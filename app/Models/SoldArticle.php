<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{

    protected $fillable = [
        'quantity'
    ];

    protected $guarded = [ 'id', 'user_id', 'article_id'];
}
