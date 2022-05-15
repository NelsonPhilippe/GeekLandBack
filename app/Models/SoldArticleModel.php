<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoldArticleModel extends Model
{

    protected $fillable = [
        'quantity'
    ];

    protected $guarded = [ 'id', 'user_id', 'article_id'];
}
