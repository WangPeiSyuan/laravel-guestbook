<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['content'];

    //取得此篇post撰寫之user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function message()
    {
    	return $this->hasMany(Message::class);
    }
}
