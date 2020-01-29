<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'text',
        'user_id',
        'parent_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getRepliesAttribute()
    {
        return Message::where('parent_id', $this->id)->get();
    }

}