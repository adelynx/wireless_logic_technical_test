<?php

declare(strict_types=1);

namespace App\Parsers;

use Symfony\Component\DomCrawler\Crawler;

class PageParser
{
    private SectionParser $sectionParser;

    /**
     * PageParser constructor.
     */
    public function __construct()
    {
        $this->sectionParser = new SectionParser();
    }

    /**
     * @param Crawler|null $pageDom
     *
     * @return array
     */
    public function parse(?Crawler $pageDom): array
    {
        $subscriptionsDomList = $pageDom->filter('#subscriptions');

        $productOptions = $subscriptionsDomList->each(
            fn($subscriptionsDom) => $this->sectionParser->parse($subscriptionsDom)
        );

        return array_flatten($productOptions);
    }
}
