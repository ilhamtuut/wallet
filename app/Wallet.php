<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
    	'address',
    	'private',
    	'public',
    	'status',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
