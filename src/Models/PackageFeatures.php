<?php

declare(strict_types=1);

namespace App\Models;

class PackageFeatures
{
    public string $description;

    public PackagePrice $price;

    /**
     * ProductOption constructor.
     *
     * @param string $description
     * @param PackagePrice $price
     */
    public function __construct(string $description, PackagePrice $price)
    {
        $this->description = $description;
        $this->price = $price;
    }
}
