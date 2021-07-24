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

