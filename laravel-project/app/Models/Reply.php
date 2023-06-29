<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'reply', 'comment_id'];
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected function shortReply(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => Str::words(strip_tags($attributes['reply']), 5),
        );
    }
}
