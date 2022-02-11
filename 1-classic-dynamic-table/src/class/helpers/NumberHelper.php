<?php
namespace App\class\helpers;


class NumberHelper {
    public static function priceFormat(float $price, string $symbol = "円"): string
    {
        $newPrice = number_format($price, 0, '.', '.');
        return $newPrice . $symbol;
    }
}