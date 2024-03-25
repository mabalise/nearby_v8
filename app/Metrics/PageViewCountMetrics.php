<?php

namespace App\Metrics;

use Spatie\Analytics\Analytics;

class PageViewCountMetrics
{
    public function name(): string
    {
        return 'page_view_count';
    }

    public function calculate(): int
    {
        // Récupérer le nombre de pages vues depuis Google Analytics
        return Analytics::fetchMostVisitedPages(Period::days(1))
            ->sum('pageviews');
    }
}
