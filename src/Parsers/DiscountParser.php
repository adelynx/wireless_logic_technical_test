<?php

declare(strict_types=1);

namespace App\Parsers;

use Symfony\Component\DomCrawler\Crawler;

class DiscountParser
{
    /**
     * @param Crawler|null $packageFeaturesDom
     *
     * @return float
     */
    public function parse(?Crawler $packageFeaturesDom): float
    {
        $discountDom = $this->getPackageFeaturesDom($packageFeaturesDom);

        return $this->getDiscount($discountDom);
    }

    /**
     * @param Crawler|null $packageFeaturesDom
     *
     * @return Crawler|null
     */
    private function getPackageFeaturesDom(?Crawler $packageFeaturesDom): ?Crawler
    {
        return $packageFeaturesDom->filter('p');
    }

    /**
     * @param Crawler|null $discountDom
     *
     * @return float
     */
    private function getDiscount(?Crawler $discountDom): float
    {
        if ($discountDom->count() > 0) {
            $discountText = $discountDom->text();

            if ($this->hasDiscount($discountText)) {
                return get_price($discountText);
            }
        }

        return 0;
    }

    /**
     * @param string $discount
     *
     * @return bool
     */
    private function hasDiscount(string $discount): bool
    {
        return str_contains($discount, 'Save');
    }
}
