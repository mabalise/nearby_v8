<?php

namespace App\Metrics;

use Spatie\Analytics\Analytics;

class RewardViewCountMetrics
{
    public function name(): string
    {
        return 'reward_view_count';
    }

    public function calculate(): int
    {
        // Logique pour récupérer les données de vue des récompenses depuis Google Analytics (inchangée)
        $data = Analytics::fetchMostVisitedPages(Period::days(1));
        $rewardViews = 0;
        foreach ($data as $page) {
            if ($page['path'] === '/rewards') {
                $rewardViews = $page['pageviews'];
                break;
            }
        }

        return $rewardViews;
    }
}
