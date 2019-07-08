<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function (Category $category) {
            $category->posts()->delete();
        });
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
