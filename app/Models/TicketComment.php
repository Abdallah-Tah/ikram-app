<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TicketComment extends Pivot
{
    use HasFactory;

    protected $table = 'ticket_comments';

    protected $fillable = [
        'ticket_id',
        'comment',
        'user_id'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
