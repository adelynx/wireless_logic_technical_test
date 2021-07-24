<?php

declare(strict_types=1);

namespace App\Models;

class PackagePrice
{
    public float $price;

    public float $discount;

    /**
     * PackagePrice constructor.
     *
     * @param float $price
     * @param float $discount
     */
    public function __construct(float $price, float $discount)
    {
        $this->price = $price;
        $this->discount = $discount;}
}
