<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function videos(){
        return $this->morphToMany(Tag::class,'taggable');
    }
}
