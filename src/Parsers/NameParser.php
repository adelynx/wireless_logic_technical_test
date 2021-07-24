<?php

declare(strict_types=1);

namespace App\Parsers;

use Symfony\Component\DomCrawler\Crawler;

class NameParser
{
    /**
     * Returns the package name.
     *
     * @param Crawler|null $nameDom
     *
     * @return string
     */
    public function parse(?Crawler $nameDom): string
    {
        return $nameDom->text();
    }
}
