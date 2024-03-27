<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DealStat extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deal_stats';

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

    public function deal(): HasOne
    {
        return $this->hasOne(\App\Deal::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\User::class);
    }
}
