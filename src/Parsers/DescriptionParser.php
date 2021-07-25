<?php

declare(strict_types=1);

namespace App\Parsers;

use Symfony\Component\DomCrawler\Crawler;

class DescriptionParser
{
    /**
     * @param Crawler|null $packageFeaturesDom
     *
     * @return string
     */
    public function parse(?Crawler $packageFeaturesDom): string
    {
        // TODO::to be implemented
    }
}
