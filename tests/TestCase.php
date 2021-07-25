<?php

declare(strict_types=1);

namespace Test;

use App\Parsers\PageParser;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Return fake server request DOM.
     *
     * @return Crawler|null
     */
    protected function getFakeDom(): ?Crawler
    {
        $client = new Client();

        return $client->request('GET', 'http://localhost:8000');
    }

    /**
     * Return live server request DOM.
     *
     * @return Crawler|null
     */
    protected function getDom(): ?Crawler
    {
        $client = new Client();

        return $client->request('GET', 'https://videx.comesconnected.com');
    }

    /**
     * @return PageParser
     */
    protected function pageParser(): PageParser
    {
        return new PageParser();
    }

    /**
     * @param array $productOptions
     *
     * @return array
     */
    protected function orderByAnnualPriceDesc(array $productOptions): array
    {
        usort($productOptions, fn($a, $b) => $b->price <=> $a->price);

        return $productOptions;
    }
}
