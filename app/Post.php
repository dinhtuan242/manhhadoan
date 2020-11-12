<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //thuoc tinh cho phep truy xuat du lieu
    protected $fillable = ['user_id', 'title', 'slug', 'image', 'body', 'view_count', 'status', 'is_approved'];

    //function mo ta quan he voi cac class khac
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }
}
