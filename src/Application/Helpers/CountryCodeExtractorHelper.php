<?php

declare(strict_types=1);

namespace Application\Helpers;

final class CountryCodeExtractorHelper
{
    public static function getCode(string $string): int
    {
        $start = '(';
        $end = ')';

        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) {
            return 0;
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return (int) substr($string, $ini, $len);
    }
}
