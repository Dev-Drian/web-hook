<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = ['ip', 'canti_request', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
