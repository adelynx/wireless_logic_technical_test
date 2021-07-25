<?php

use App\Parsers\PageParser;
use Goutte\Client;

require 'vendor/autoload.php';

$url = "https://videx.comesconnected.com";
$client = new Client();
$pageDom = $client->request('GET', $url);

$pageParser = new PageParser();

$productOptions = $pageParser->parse($pageDom);

$productOptions = orderByAnnualPriceDesc($productOptions);

$productOptionsJson = json_encode($productOptions, true);

echo $productOptionsJson;

/**
 * @param array $productOptions
 *
 * @return array
 */
function orderByAnnualPriceDesc(array $productOptions): array
{
    usort($productOptions, fn($a, $b) => $b->price <=> $a->price);

    return $productOptions;
}
