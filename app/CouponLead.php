<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CouponLead extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupon_leads';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function getDates()
    {
        return ['created_at'];
    }

    protected $casts = [
        'field_names' => 'json',
        'field_values' => 'json',
        'meta' => 'json',
    ];

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(\App\Coupon::class);
    }
}
