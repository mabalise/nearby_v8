<?php

namespace App;

use Czim\Paperclip\Contracts\AttachableInterface;
use Czim\Paperclip\Model\PaperclipTrait;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model implements AttachableInterface
{
    use PaperclipTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    protected $casts = [
        'valid_from_date' => 'datetime',
        'expiration_date' => 'datetime',
        'expiration_date_time' => 'datetime',
        'last_redemption' => 'datetime',
        'fields' => 'json',
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
        $url = url('coupon/'.\App\Http\Controllers\Core\Secure::staticHash($this->id));

        return $url;
    }

    public function getFavicon()
    {
        $favicon = 'favicons/coupon-'.\App\Http\Controllers\Core\Secure::staticHash($this->id).'.ico';
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

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function couponLeads()
    {
        return $this->hasMany(\App\CouponLead::class);
    }

    // Removed functions from gurmanalexander/laravel-metrics

    // You can potentially replace these with relevant metrics

    // public function getMetric1()
    // {
    //     // Replace with logic to get a relevant metric using Spatie\Analytics\Analytics facade
    //     // Example: return Analytics::getVisitorsCount(); // This might not be relevant for coupons
    // }

    // public function getMetric2()
    // {
    //     // Replace with logic to get a relevant metric using Spatie\Analytics\Analytics facade
    //     // Example: return Analytics::getBounceRate(); // This might not be relevant for coupons
    // }
}
