<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // scope define
    public function scopePending($query)
    {
    	return $query->where('status', 0);
    }
    
    public function scopePublish($query)
    {
    	return $query->where('status', 1);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function favorite_to_users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
