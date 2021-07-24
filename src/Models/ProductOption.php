<?php

declare(strict_types=1);

namespace App\Models;

class ProductOption
{
    public string $name;

    public string $description;

    public float $price;

    public float $discount;

    /**
     * ProductOption constructor.
     *
     * @param string $name
     * @param string $description
     * @param float $price
     * @param float $discount
     */
    public function __construct(string $name, string $description, float $price, float $discount)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->discount = $discount;
    }
}
