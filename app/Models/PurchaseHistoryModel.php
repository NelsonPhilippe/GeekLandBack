<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{


    protected $fillable = [
        'genre_id', 'name', 'description', 'price', 'date', 'stock', 'production', 'brand'
    ];

    protected $guarded = [ 'id' ];

}
