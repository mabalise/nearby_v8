<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Czim\Paperclip\Contracts\AttachableInterface;
use Czim\Paperclip\Model\PaperclipTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements AttachableInterface
{
    use Notifiable;
    use PaperclipTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referrer_user_id', 'referrer_token', 'name', 'email', 'role', 'active', 'password', 'trial_ends_at', 'reseller_host', 'admin_host', 'locale',
    ];

    protected $casts = [
        'settings' => 'json',
        'meta' => 'json',
    ];

    public function getDates()
    {
        return ['created_at', 'updated_at', 'last_login', 'last_payout', 'expires', 'trial_ends_at'];
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Fix for Stapler: https://github.com/CodeSleeve/laravel-stapler/issues/64
     *
     * Get all of the current attributes on the model.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return parent::getAttributes();
    }

    public function __construct(array $attributes = [])
    {

        $this->hasAttachedFile('avatar', [
            'variants' => [
                'favicon' => '32x32#',
                'logo' => 'x76',
            ],
        ]);

        parent::__construct($attributes);
    }

    public function parentUser(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'parent_id');
    }

    public function childUsers(): HasMany
    {
        return $this->hasMany(\App\User::class, 'parent_id');
    }

    public function hasRole($roles)
    {
        return in_array($this->role, $roles);
    }

    public function getRole()
    {
        return ($this->role == null) ? 'user' : $this->role;
    }

    public function deals(): HasMany
    {
        return $this->hasMany(\App\Deal::class);
    }

    public function properties(): HasMany
    {
        return $this->hasMany(\App\Property::class);
    }

    public function businessCards(): HasMany
    {
        return $this->hasMany(\App\BusinessCard::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(\App\Page::class);
    }

    public function coupons(): HasMany
    {
        return $this->hasMany(\App\Coupon::class);
    }

    public function rewards(): HasMany
    {
        return $this->hasMany(\App\Reward::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(\App\Video::class);
    }

    public function qr_codes(): HasMany
    {
        return $this->hasMany(\App\Qr::class);
    }
}
