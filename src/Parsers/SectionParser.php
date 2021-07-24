<?php

declare(strict_types=1);

namespace App\Parsers;

use Symfony\Component\DomCrawler\Crawler;

class SectionParser
{
    private PackageParser $packageParser;

    /**
     * SectionParser constructor.
     */
    public function __construct()
    {
        $this->packageParser = new PackageParser();
    }

    /**
     * Parse the list of nodes with a CSS selector.
     *
     * @param Crawler|null $subscriptionsDom
     *
     * @return array
     */
    public function parse(?Crawler $subscriptionsDom): array
    {
        $packagesDomList = $subscriptionsDom->filter('.package');

        return $packagesDomList->each(
            fn($packageDom) => $this->packageParser->parse($packageDom)
        );
    }
}
