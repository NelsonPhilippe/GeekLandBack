<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentaryModel extends Model
{

    protected $fillable = ['commentary', 'deleted'];

    protected $guarded = [ 'id', 'user_id', 'article_id'];
}
