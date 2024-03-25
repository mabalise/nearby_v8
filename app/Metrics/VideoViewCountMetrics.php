<?php

namespace App\Metrics;

use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class VideoViewCountMetrics
{
    public function handle(Analytics $analytics): int
    {
        return $analytics->query(
            Period::create('today'),
            'pageviews',
            'pagePath',
            '/video'
        );
    }
}
