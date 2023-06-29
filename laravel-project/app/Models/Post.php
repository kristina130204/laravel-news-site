<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['user_id', 'title', 'content', 'category_id', 'image', 'published'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? $value : '/images/no-image.png',
        );
    }
    protected function shortContent(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => Str::words(strip_tags($attributes['content']), 10),
        );
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
