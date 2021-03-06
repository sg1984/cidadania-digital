<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketComment extends Model
{
    public const TYPE_USER_COMMENT = 1;
    public const TYPE_SYSTEM_COMMENT = 2;

    protected $fillable = [
        'comment_type', 'ticket_id', 'created_by',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function comments()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
