<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sourcecomment extends Model
{
    protected $fillable = ['sourcecode_id','name','email','message'];
}
