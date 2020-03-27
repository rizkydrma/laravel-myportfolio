<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','slug'];

    public function post()
    {
        // relasi one to many (1 Category memiliki banyak Post)
        return $this->hasMany('App\Post');
    }

    // mengubah parameter di route menjadi dapat menerima slug 
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
