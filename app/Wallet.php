<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'label',
    	'address',
        'port',
        'p2p',
    	'endpoind_port',
    	'endpoind_p2p',
    	'status',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
