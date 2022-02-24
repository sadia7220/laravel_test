<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    //
    protected $fillable = [
        'email', 'user_id', 'access_level', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
