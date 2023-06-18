<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    const ACTIVE = 0;
    const DEACTIVE = 1;

    protected $fillable = [
        'problem_description',
        'received_date',
        'affected_user',
        'ticket_number',
        'additional_notes',
        'is_deleted',
    ];

    protected $dates = [
        // 'received_date',
    ];
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
