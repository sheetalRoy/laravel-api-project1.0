<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'pin', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
