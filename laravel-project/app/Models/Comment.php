<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'comment', 'article_id', 'post_id', 'published'];
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    
    protected function shortComment(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => Str::words(strip_tags($attributes['comment']), 5),
        );
    }
}
