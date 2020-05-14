<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use SoftDeletes;

    const FORMAT_TEXT = 1;
    const FORMAT_VIDEO = 2;
    const FORMAT_AUDIO = 3;
    const FORMAT_IMAGE = 4;

    const FORMAT_ICONS = [
        self::FORMAT_TEXT => 'far fa-file-alt',
        self::FORMAT_VIDEO => 'fas fa-video',
        self::FORMAT_AUDIO => 'fas fa-volume-up',
        self::FORMAT_IMAGE => 'fas fa-image',
    ];

    const FORMAT_TYPES = [
        self::FORMAT_TEXT => 'Texto',
        self::FORMAT_VIDEO => 'Vídeo',
        self::FORMAT_AUDIO => 'Audio',
        self::FORMAT_IMAGE => 'Imagem',
    ];

    protected $fillable = [
        'title', 'author', 'key_words', 'description', 'publisher',
        'source', 'format_id', 'language', 'subject_id', 'created_by',
        'deleted_by', 'published_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    /**
     * Saving the user that deleted the content
     */
    public static function boot() {
        parent::boot();
        static::deleting(function($table)  {
            $table->deleted_by = auth()->id();
            $table->save();
        });
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return string
     */
    public function getFormatDescription(): string
    {
        return self::FORMAT_TYPES[$this->format_id];
    }

    /**
     * @return string
     */
    public function getFormatIcon(): string
    {
        return self::FORMAT_ICONS[$this->format_id];
    }

    /**
     * @param int $tagId
     * @return bool
     */
    public function isTagSelected(int $tagId): bool
    {
        foreach ($this->tags as $tag){
            if($tag->id === $tagId) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->whereNotNull('published_at');
    }
}
