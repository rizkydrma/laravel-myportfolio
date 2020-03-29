<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sourcecode extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','category_id','image','content','download','video','slug','user_id','color'];

    // Relasi one to many Source code ke category
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    // Relasi Many to Many SourceCode dan Tag menggunakan table sourcecode_tag
    public function tag()
    {
        return $this->belongsToMany('App\Tag');
    }

    // Relasi one to many SourceCode dan user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
