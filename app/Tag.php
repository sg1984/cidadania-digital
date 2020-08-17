<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['name', 'is_active'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * @return BelongsToMany
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
        return ! ($this->subjects()->exists() || $this->resources()->exists());
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsActive(Builder $query)
    {
        return $query->where('is_active', '=', true);
    }


    /**
     * @param array $storeData
     * @return Tag|null
     */
    public static function findOrCreate(array $storeData):? Tag
    {
        $name = $storeData['name'];
        if ($name) {
            $tag = Tag::query()
                ->whereRaw("UPPER(name) = '" . strtoupper($name) . "'")
                ->first();

            if($tag){
                return $tag;
            }

            return Tag::create($storeData);
        }

        return null;
    }

    public function scopeByName(Builder $query, string $name)
    {
        return $query->where('name', '=', $name);
    }
}
