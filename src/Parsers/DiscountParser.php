<?php

declare(strict_types=1);

namespace App\Parsers;

use Symfony\Component\DomCrawler\Crawler;

class DiscountParser
{
    /**
     * @param Crawler|null $packageFeaturesDom
     *
     * @return float
     */
    public function parse(?Crawler $packageFeaturesDom): float
    {
        // TODO::to be implemented
    }
}
