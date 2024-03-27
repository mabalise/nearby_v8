<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RewardLead extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reward_leads';

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
        'field_values' => 'json',
        'meta' => 'json',
    ];

    public function reward(): BelongsTo
    {
        return $this->belongsTo(\App\Reward::class);
    }
}
