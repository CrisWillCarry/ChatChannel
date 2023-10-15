<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    use HasFactory;

    protected $fillable=[
        'username',
        'password',
        'imageURL'
    ];

    public $timestamps = false;
    
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
