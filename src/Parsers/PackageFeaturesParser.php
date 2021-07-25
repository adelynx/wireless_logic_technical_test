<?php

declare(strict_types=1);

namespace App\Parsers;

use App\Models\PackageFeatures;
use Symfony\Component\DomCrawler\Crawler;

class PackageFeaturesParser
{
    private PriceParser $priceParser;

    private DescriptionParser $descriptionParser;

    /**
     * PackageFeaturesParser constructor.
     *
     */
    public function __construct()
    {
        $this->priceParser = new PriceParser();
        $this->descriptionParser = new DescriptionParser();
    }

    /**
     * @param Crawler|null $packageFeaturesDom
     *
     * @return PackageFeatures
     */
    public function parse(?Crawler $packageFeaturesDom): PackageFeatures
    {
        $packageDescription = $this->descriptionParser->parse($packageFeaturesDom);
        $packagePrice = $this->priceParser->parse($packageFeaturesDom);

        return new PackageFeatures($packageDescription, $packagePrice);
    }
}
