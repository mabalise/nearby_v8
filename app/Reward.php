<?php

namespace App;

use Czim\Paperclip\Contracts\AttachableInterface;
use Czim\Paperclip\Model\PaperclipTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reward extends Model implements AttachableInterface
{
    use PaperclipTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rewards';

    protected $casts = [
        'valid_from_date' => 'datetime',
        'expiration_date' => 'datetime',
        'expiration_date_time' => 'datetime',
        'fields' => 'json',
        'meta' => 'json',
        'settings' => 'json',
    ];

    /**
     * Fix for Stapler: https://github.com/CodeSleeve/laravel-stapler/issues/64
     *
     * Get all of the current attributes on the model.
     */
    public function getAttributes(): array
    {
        return parent::getAttributes();
    }

    public function getUrl()
    {
        $url = url('reward/'.\App\Http\Controllers\Core\Secure::staticHash($this->id));

        return $url;
    }

    public function getFavicon()
    {
        $favicon = 'favicons/reward-'.\App\Http\Controllers\Core\Secure::staticHash($this->id).'.ico';
        $favicon = (\File::exists(public_path($favicon))) ? url($favicon) : null;

        return $favicon;
    }

    public function __construct(array $attributes = [])
    {

        $this->hasAttachedFile('image', [
            'variants' => [
                'favicon' => '32x32#',
                'icon-s' => '320x320#',
                '1xportrait' => 'x160',
                '1x' => '160',
                '2x' => '800',
                '4x' => '1920',
            ],
        ]);

        parent::__construct($attributes);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\User::class);
    }

    public function rewardLeads(): HasMany
    {
        return $this->hasMany(\App\RewardLead::class);
    }

    // Removed functions from gurmanalexander/laravel-metrics

    // You can potentially replace these with relevant metrics

    // public function getMetric1()
    // {
    //     // Replace with logic to get a relevant metric using appropriate analytics tools
    // }

    // public function getMetric2()
    // {
    //     // Replace with logic to get a relevant metric using appropriate analytics tools
    // }
}
