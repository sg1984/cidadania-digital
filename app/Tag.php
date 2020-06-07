<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'is_active'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resources()
    {
        return $this->belongsToMany(Resource::class);
    }

    /**
     * @return bool
     */
    public function canBeExcluded()
    {
        return ! ($this->subjects()->exists() || $this->subjects()->exists());
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsActive(Builder $query)
    {
        return $query->where('is_active', '=', true);
    }
}
