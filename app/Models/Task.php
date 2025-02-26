<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'status',
        'user_id',
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
}
