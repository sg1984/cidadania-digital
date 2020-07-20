<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Ticket extends Model
{
    const TAB_TICKETS_ALL = 'TAB_TICKETS_ALL';
    const TAB_TICKETS_SENT = 'TAB_TICKETS_SENT';
    const TAB_TICKETS_RECEIVED = 'TAB_TICKETS_RECEIVED';

    const STATUSES_TEXTS = [
        self::STATUS_OPEN => 'Aberto',
        self::STATUS_IN_PROGRESS => 'Em progresso',
        self::STATUS_DONE => 'Realizado',
        self::STATUS_CLOSED_NOT_DONE => 'Não realizado',
    ];

    const STATUS_OPEN = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_DONE = 2;
    const STATUS_CLOSED_NOT_DONE = 3;

    const TYPE_SYSTEM_REPORT_BUG = 1;
    const TYPE_HELP = 2;
    const TYPE_REPORT_RESOURCE = 3;

    protected $fillable = [
        'ticket_type', 'title', 'description',
        'status', 'created_by', 'responsible_id',
        'updated_by', 'created_by', 'responsible_id',
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
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * @return BelongsTo
     */
    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    /**
     * @return BelongsToMany
     */
    public function comments()
    {
        return $this->belongsToMany(TicketComment::class);
    }

    /**
     * @param Builder $query
     * @param User    $user
     * @return Builder
     */
    public function scopeByCreatedUser(Builder $query, User $user)
    {
        return $query->where('created_by', '=', $user->id);
    }

    /**
     * @param Builder $query
     * @param User    $user
     * @return Builder
     */
    public function scopeByResponsibleUser(Builder $query, User $user)
    {
        return $query->where('responsible_id', '=', $user->id);
    }

    /**
     * @return string
     */
    public function getStatusText()
    {
        return self::STATUSES_TEXTS[$this->status];
    }
}
