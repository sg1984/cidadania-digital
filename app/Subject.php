<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'is_active'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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
