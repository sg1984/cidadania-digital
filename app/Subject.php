<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = ['name', 'is_active'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return bool
     */
    public function canBeExcluded()
    {
        return ! ($this->resources()->exists() || $this->users()->exists());
    }

    /**
     * @param int $tagId
     * @return bool
     */
    public function isTagAssociated(int $tagId): bool
    {
        foreach ($this->tags as $tag){
            if($tag->id === $tagId) {
                return true;
            }
        }

        return false;
    }
}
