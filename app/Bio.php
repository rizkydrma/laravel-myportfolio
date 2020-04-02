<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    protected $fillable = ['about'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
