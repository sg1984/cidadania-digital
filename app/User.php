<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'remember_token',
        'is_active', 'wiki_access_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function resources()
    {
        return $this->hasMany(Resource::class, 'created_by');
    }

    /**
     * @return BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * @return HasMany
     */
    public function createdTickets()
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }

    /**
     * @return HasMany
     */
    public function receivedTickets()
    {
        return $this->hasMany(Ticket::class, 'responsible_id');
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * @return Builder|Model
     */
    public static function getAdminUser()
    {
        return User::query()
            ->firstWhere('is_admin', '=', true);
    }

    public function getWikiAccessToken()
    {
        return $this->wiki_access_token;
    }

    public function getWikiUrl()
    {
        $baseUrl = env('WIKI_BASE_URL');

        if($this->getWikiAccessToken()) {
            $baseUrl .= 'api.php?action=loginWithToken&format=json&loginToken=' . $this->getWikiAccessToken();
        }

        return $baseUrl;
    }

    public function hasWikiAccess()
    {
        return $this->getWikiAccessToken();
    }
}
