<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $date = ['deleted_at'];
    protected $fillable = [
        'subject','remark'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function photos(){
        return $this->morphMany(Photo::class,'image','image_type', 'image_id');
    }
    public function tags(){
        return $this->morphToMany(Tag::class,'taggable');
    }
}
