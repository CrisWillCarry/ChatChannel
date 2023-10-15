<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable=[
        'message',
        'date',
        'senderId',
        'receiverId'
    ];

    public function chatuser(): BelongsTo
    {
        return $this->belongsTo(ChatUser::class);
    }
}
