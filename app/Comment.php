<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
      'message', 'post_id', 'user_id',
    ];

    public function user(){
      return $this->belongsTo(User::class);
    }
}
