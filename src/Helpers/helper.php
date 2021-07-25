<?php

declare(strict_types=1);

if (! function_exists('array_flatten')) {
    /**
     * Flattens a multi-dimensional array into a single level array
     *
     * NOTE: Inspired from Laravel Arr::flatten() helper method.
     *
     * @param array $array
     *
     * @return array
     */
    function array_flatten(array $array): array
    {
        $return = [];

        array_walk_recursive(
            $array,
            function ($a) use (&$return) {
                $return[] = $a;
            }
        );

        return $return;
    }
}

if (! function_exists('convert_html_break_lines')) {
    /**
     * Convert html break lines "<br>" to console format "\n"
     *
     * @param string $text
     *
     * @return string
     */
    function convert_html_break_lines(string $text): string
    {
        return str_replace('<br>', PHP_EOL, $text);
    }
}

if (! function_exists('get_price')) {
    /**
     * Get the price without currency from the text.
     *
     * @param string $text
     *
     * @return float
     */
    function get_price(string $text): float
    {
        return (float)preg_replace('/[^.\d]/', '', $text);
    }
}

if (! function_exists('array_to_json')) {
    /**
     * Get the price without currency from the text.
     *
     * @param array $array
     *
     * @return string
     */
    function array_to_json(array $array): string
    {
        return json_encode($array);
    }
}
