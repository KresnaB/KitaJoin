<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'post_name','location','type',
        'category','poster','description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
