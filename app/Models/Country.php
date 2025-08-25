<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function posts(){
        return $this->hasManyThrough(Post::class, User::class,"country_id","user_id");
        //* user_id is from Post table and country_id from User table
    }
}
