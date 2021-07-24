<?php

declare(strict_types=1);

namespace App\Parsers;

use App\Models\PackageFeatures;
use App\Models\ProductOption;
use Symfony\Component\DomCrawler\Crawler;

class PackageParser
{
    private NameParser $nameParser;

    private PackageFeaturesParser $packageFeaturesParser;

    private ?Crawler $packageDom;

    /**
     * PackageParser constructor.
     */
    public function __construct()
    {
        $this->nameParser = new NameParser();
        $this->packageFeaturesParser = new PackageFeaturesParser();
    }

    /**
     * @param Crawler|null $packageDom
     *
     * @return ProductOption
     */
    public function parse(?Crawler $packageDom): ProductOption
    {
        $name = $this->parseName($packageDom);
        $packageFeatures = $this->ParsePackageFeatures($packageDom);

        return new ProductOption(
            $name,
            $packageFeatures->description,
            $packageFeatures->price->price,
            $packageFeatures->price->discount
        );
    }

    /**
     * @param Crawler|null $packageDom
     *
     * @return string
     */
    private function parseName(?Crawler $packageDom): string
    {
        $this->packageDom = $packageDom;

        $nameDom = $this->getNameDom();

        return $this->nameParser->parse($nameDom);
    }

    /**
     * Returns the title DOMElement.
     *
     * @return Crawler|null
     */
    private function getNameDom(): ?Crawler
    {
        return $this->packageDom
            ->filter('.header');
    }

    /**
     * @param Crawler|null $packageDom
     *
     * @return PackageFeatures
     */
    private function ParsePackageFeatures(?Crawler $packageDom): PackageFeatures
    {
        $packageFeaturesDom = $this->getPackageFeaturesDom($packageDom);

        return $this->packageFeaturesParser->parse($packageFeaturesDom);
    }

    /**
     * @param Crawler|null $packageDom
     *
     * @return Crawler|null
     */
    private function getPackageFeaturesDom(?Crawler $packageDom): ?Crawler
    {
        return $packageDom->filter('.package-features');
    }
}
