<?php

declare(strict_types=1);

namespace App\Parsers;

use App\Models\PackagePrice;
use Symfony\Component\DomCrawler\Crawler;

class PriceParser
{
    /**
     * @param Crawler|null $packagePriceDom
     *
     * @return PackagePrice
     */
    public function parse(?Crawler $packagePriceDom): PackagePrice
    {
        // TODO::to be implemented
    }
}
