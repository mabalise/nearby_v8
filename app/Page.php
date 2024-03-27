<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Czim\Paperclip\Contracts\AttachableInterface;
use Czim\Paperclip\Model\PaperclipTrait;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements AttachableInterface
{
    use PaperclipTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

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
    public function getAttributes()
    {
        return parent::getAttributes();
    }

    public function getUrl()
    {
        $url = url('page/'.\App\Http\Controllers\Core\Secure::staticHash($this->id));

        return $url;
    }

    public function getFavicon()
    {
        $favicon = 'favicons/page-'.\App\Http\Controllers\Core\Secure::staticHash($this->id).'.ico';
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

        $this->hasAttachedFile('icon', [ // Assuming 'icon' is for a smaller representation
            'variants' => [
                's' => '64x64#',
            ],
        ]);

        parent::__construct($attributes);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\User::class);
    }

    // Removed functions from gurmanalexander/laravel-metrics

    // You likely don't need metrics functionality for pages unless you're tracking visits or other engagement metrics.
}
