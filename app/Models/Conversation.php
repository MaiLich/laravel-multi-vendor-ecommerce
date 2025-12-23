<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';

    protected $fillable = ['user_id', 'admin_id'];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    // Quan hệ với Admin
    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'admin_id');
    }

    // Tất cả tin nhắn
    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class, 'conversation_id');
    }

    // TIN NHẮN MỚI NHẤT – BẮT BUỘC PHẢI CÓ DÒNG NÀY
    public function latestMessage()
    {
        return $this->hasOne(\App\Models\Message::class, 'conversation_id')->latestOfMany();
    }
}