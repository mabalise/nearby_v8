<?php

namespace App\Metrics;

use Spatie\Analytics\Analytics;

class PropertyViewCountMetrics
{
    public function name(): string
    {
        return 'property_view_count';
    }

    public function calculate(): int
    {
        // Récupérer le nombre de vues de pages de propriétés depuis Google Analytics
        // (nécessite des ajustements en fonction de votre configuration)

        // Remplacez cette ligne par votre logique pour identifier les pages de propriétés
        $propertyViewPaths = ['/properties', '/property/*']; // Exemples de chemins

        $data = Analytics::fetchMostVisitedPages(Period::days(1));
        $propertyViews = 0;

        foreach ($data as $page) {
            foreach ($propertyViewPaths as $path) {
                if (str_is($page['path'], $path)) {
                    $propertyViews += $page['pageviews'];
                    break; // Sortir de la boucle interne une fois une correspondance trouvée
                }
            }
        }

        return $propertyViews;
    }
}
