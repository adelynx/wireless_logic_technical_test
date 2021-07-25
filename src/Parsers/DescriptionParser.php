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
        $packageDescriptionDom = $packageFeaturesDom->filter('.package-name');
        $description = $packageDescriptionDom->html();

        return convert_html_break_lines($description);
    }
}
