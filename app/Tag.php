<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','slug'];

    // Relasi many to many POST dan Category harus menggunakan table baru post_tag
    public function post()
    {
        return $this->belongsToMany('App\Post');
    }

    public function sourcecode()
    {
        return $this->belongsToMany(Sourcecode::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
