<?php

declare(strict_types=1);

namespace Test\Console;

use Test\TestCase;

class ApplicationTest extends TestCase
{
    /**
     * NOTE: I combine all the expectation of the program in one test
     * for the timing reason (2 hours not enough to cover all code)
     * so I tried to write one test to check if the program will
     * work as expected.
     *
     * In real world I should write tests for each Class and each functions
     * and for each method I should test also all the cases found in the
     * method like each "if" is a test.
     *
     */
    public function test_app_should_returns_a_json_array_of_all_the_product_options_on_the_page_with_keys_corresponding_to_item()
    {
        $pageDom = $this->getDom();
        $fakePageDom = $this->getFakeDom();

        $fakeProductOptions = $this->pageParser()->parse($fakePageDom);
        $productOptions = $this->pageParser()->parse($pageDom);

        $fakeProductOptions = $this->orderByAnnualPriceDesc($fakeProductOptions);
        $productOptions = $this->orderByAnnualPriceDesc($productOptions);

        $fakeProductOptionsJson = json_encode($fakeProductOptions);
        $productOptionsJson = json_encode($productOptions);

        $this->assertEquals($productOptions, $fakeProductOptions);
        $this->assertJsonStringEqualsJsonString($productOptionsJson, $fakeProductOptionsJson);

        foreach ($productOptions as $productOption) {
            $this->assertObjectHasAttribute('name', $productOption);
            $this->assertObjectHasAttribute('description', $productOption);
            $this->assertObjectHasAttribute('price', $productOption);
            $this->assertObjectHasAttribute('discount', $productOption);
        }
    }
}
