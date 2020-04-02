<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected  $fillable = ['title','category_id','content','image','slug','user_id'];
    // Relasi one to many POST ke Category
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    // Relasi many to many POST dan tag harus menggunakan table baru post_tag
    public function tag()
    {
        return $this->belongsToMany('App\Tag');
    }

    // Relasi one to many POST ke Table User
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
