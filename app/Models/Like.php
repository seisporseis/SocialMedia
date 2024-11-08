<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'post_id'
    ];

    // public function user() {
    //     return $this->belongsTo(User::class)->select(['name', 'username']);
    // }

    // public function comments() {
    //     return $this->hasMany(Comment::class);
    // }
}
