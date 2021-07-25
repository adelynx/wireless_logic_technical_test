<?php

namespace App\Console;

use App\Parsers\PageParser;
use Goutte\Client;

class Application
{
    private PageParser $pageParser;

    /**
     * Application constructor.
     *
     */
    public function __construct()
    {
        $this->pageParser = new PageParser();
    }

    /**
     * @return string
     */
    public function run(): string
    {
        $url = "https://videx.comesconnected.com";
        $client = new Client();
        $pageDom = $client->request('GET', $url);

        $productOptions = $this->pageParser->parse($pageDom);

        $productOptions = $this->orderByAnnualPriceDesc($productOptions);
        
        return array_to_json($productOptions);
    }

    /**
     * @param array $productOptions
     *
     * @return array
     */
    private function orderByAnnualPriceDesc(array $productOptions): array
    {
        usort($productOptions, fn($a, $b) => $b->price <=> $a->price);

        return $productOptions;
    }
}
