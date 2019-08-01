<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $table = 'posts';
  protected $fillable = [
    'description', 'icon', 'user_id', 'group_id',
  ];

  public function comments(){
    return $this->hasMany(Comment::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function group(){
    return $this->belongsTo(Group::class);
  }
}
