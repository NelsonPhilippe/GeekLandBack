<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{


    protected $fillable = [
        'genre_id', 'name', 'description', 'price', 'date', 'stock', 'production', 'brand'
    ];

}
