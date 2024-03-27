<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Czim\Paperclip\Contracts\AttachableInterface;
use Czim\Paperclip\Model\PaperclipTrait;
use Illuminate\Database\Eloquent\Model;

class BusinessCard extends Model implements AttachableInterface
{
    use PaperclipTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_cards';

    protected $casts = [
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
        $url = url('card/'.\App\Http\Controllers\Core\Secure::staticHash($this->id));

        return $url;
    }

    public function getFavicon()
    {
        $favicon = 'favicons/card-'.\App\Http\Controllers\Core\Secure::staticHash($this->id).'.ico';
        $favicon = (\File::exists(public_path($favicon))) ? url($favicon) : null;

        return $favicon;
    }

    public function __construct(array $attributes = [])
    {

        $this->hasAttachedFile('image', [
            'variants' => [
                'favicon' => '32x32#',
                'icon-s' => '320x320#',
                'icon-l' => '800x800#', // Assuming a larger icon is desired
                '1xportrait' => 'x160',
                '1x' => '160',
                '2x' => '800',
                '4x' => '1920',
            ],
        ]);

        $this->hasAttachedFile('avatar', [
            'variants' => [
                's' => '64x64#',
                'm' => '256x256#',
                'l' => '512x512#',
            ],
        ]);

        parent::__construct($attributes);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\User::class);
    }

    // Removed functions from gurmanalexander/laravel-metrics

    // You likely don't need metrics functionality for business cards.
}
