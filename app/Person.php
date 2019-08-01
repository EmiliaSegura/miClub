<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table='persons';

    protected $fillable = [
        'name','last_name', 'sex', 'avatar', 'email',
    ];

    public function user(){
    	return $this->belongsTo(user::class);
    }
}
