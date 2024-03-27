<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Czim\Paperclip\Contracts\AttachableInterface;
use Czim\Paperclip\Model\PaperclipTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Analytics\Analytics; // Assuming this is the library used for analytics

class Deal extends Model implements AttachableInterface
{
    use PaperclipTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deals';

    protected $casts = [
        'valid_from_date' => 'datetime',
        'expiration_date' => 'datetime',
        'expiration_date_time' => 'datetime',
        'meta' => 'json',
        'settings' => 'json',
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

    public function getUrl()
    {
        $url = url('deal/'.\App\Http\Controllers\Core\Secure::staticHash($this->id));

        return $url;
    }

    public function getFavicon()
    {
        $favicon = 'favicons/deal-'.\App\Http\Controllers\Core\Secure::staticHash($this->id).'.ico';
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

    // Removed functions from gurmanalexander/laravel-metrics

    // You can potentially replace these with functions from spatie/laravel-analytics

    // public function getMetric1()
    // {
    //     // Replace with logic to get metric 1 using Spatie\Analytics\Analytics facade
    //     // Example: return Analytics::getVisitorsCount();
    // }

    // public function getMetric2()
    // {
    //     // Replace with logic to get metric 2 using Spatie\Analytics\Analytics facade
    //     // Example: return Analytics::getBounceRate();
    // }
}
