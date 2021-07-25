<?php

declare(strict_types=1);

namespace App\Parsers;

use App\Models\PackagePrice;
use Symfony\Component\DomCrawler\Crawler;

class PriceParser
{
    private DiscountParser $discountParser;

    /**
     * PriceParser constructor.
     *
     */
    public function __construct()
    {
        $this->discountParser = new DiscountParser();
    }

    /**
     * Return the annual price of the package
     *
     * NOTE: I assumed that the currency is always £ to easy get the price without
     * the currency to keep the implementation simple for the technical test.
     *
     * @param Crawler|null $packageFeaturesDom
     *
     * @return PackagePrice
     */
    public function parse(?Crawler $packageFeaturesDom): PackagePrice
    {
        $packagePriceDom = $this->getPackageFeaturesDom($packageFeaturesDom);
        $packagePrice = $this->getPackagePrice($packagePriceDom);
        $price = $this->calculateAnnualPrice($packagePrice);
        $discount = $this->discountParser->parse($packageFeaturesDom);

        return new PackagePrice($price, $discount);
    }

    /**
     * @param Crawler|null $packageFeaturesDom
     *
     * @return Crawler|null
     */
    private function getPackageFeaturesDom(?Crawler $packageFeaturesDom): ?Crawler
    {
        return $packageFeaturesDom->filter('.package-price');
    }

    /**
     * Returns the package price.
     *
     * @param Crawler|null $packagePriceDom
     *
     * @return string
     */
    private function getPackagePrice(?Crawler $packagePriceDom): string
    {
        return $packagePriceDom->text();
    }

    /**
     * Return the annual price from the price description.
     *
     * @param string $packagePrice
     *
     * @return float
     */
    private function calculateAnnualPrice(string $packagePrice): float
    {
        $price = get_price($packagePrice);
        $isMonthly = $this->isMonthly($packagePrice);

        if ($isMonthly) {
            return $price * 12;
        }

        return $price;
    }

    /**
     * Check if the subscription package price is per month.
     *
     * @param string $packagePrice
     *
     * @return bool
     */
    private function isMonthly(string $packagePrice): bool
    {
        return str_contains($packagePrice, 'Month');
    }
}
