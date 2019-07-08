<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'published_at', 'category_id'];

    protected $dates = ['published_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Post $post) {
            if(is_null($post->published_at)) {
                $post->published_at = time();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
