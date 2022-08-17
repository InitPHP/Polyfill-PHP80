<?php
/**
 * init.php
 *
 * This file is part of PHP80.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2022 Muhammet ŞAFAK
 * @license    ./LICENSE  MIT
 * @version    1.0
 * @link       https://www.muhammetsafak.com.tr
 */

declare(strict_types=1);

if(\PHP_VERSION_ID >= 80000){
    return;
}

if(!\function_exists('fdiv')){
    function fdiv(float $num1, float $num2): float
    {
        return @($num1 / $num2);
    }
}

if(!\function_exists('preg_last_error_msg')){
    function preg_last_error_msg(): string
    {
        switch (\preg_last_error()) {
            case \PREG_INTERNAL_ERROR:
                return 'Internal error';
            case \PREG_BAD_UTF8_ERROR:
                return 'Malformed UTF-8 characters, possibly incorrectly encoded';
            case \PREG_BAD_UTF8_OFFSET_ERROR:
                return 'The offset did not correspond to the beginning of a valid UTF-8 code point';
            case \PREG_BACKTRACK_LIMIT_ERROR:
                return 'Backtrack limit exhausted';
            case \PREG_RECURSION_LIMIT_ERROR:
                return 'Recursion limit exhausted';
            case \PREG_JIT_STACKLIMIT_ERROR:
                return 'JIT stack limit exhausted';
            case \PREG_NO_ERROR:
                return 'No error';
            default:
                return 'Unknown error';
        }
    }
}

if(!\function_exists('str_contains')){
    function str_contains(string $haystack, string $needle): bool
    {
        return $needle === '' || FALSE !== \strpos($haystack, $needle);
    }
}

if(!\function_exists('str_starts_with')){
    function str_starts_with(string $haystack, string $needle): bool
    {
        return 0 === \strncmp($haystack, $needle, \strlen($needle));
    }
}

if(!\function_exists('str_ends_with')){
    function str_ends_with(string $haystack, string $needle): bool
    {
        if($needle === '' || $needle === $haystack){
            return true;
        }
        if($haystack === ''){
            return false;
        }
        $need_len = \strlen($needle);

        return $need_len <= \strlen($haystack) && 0 === \substr_compare($haystack, $needle, (0 - $need_len));
    }
}

if(!\function_exists('get_debug_type')){
    function get_debug_type($value): string
    {
        switch (true) {
            case \is_bool($value):
                return 'bool';
            case \is_null($value):
                return 'null';
            case \is_string($value):
                return 'string';
            case \is_array($value):
                return 'array';
            case \is_int($value):
                return 'int';
            case \is_float($value):
                return 'float';
            case \is_object($value):
                return \get_class($value);
            default:
                if(($type = @\get_resource_type($value)) === null){
                    return 'unknown';
                }
                if($type === 'Unknown'){
                    $type = 'closed';
                }
                return 'resource (' . $type . ')';
        }
    }
}

if(!\function_exists('get_resource_id')){
    function get_resource_id($resource): int
    {
        if(!\is_resource($resource) && null === @\get_resource_type($resource)){
            throw new \TypeError('Argument 1 passed to get_resource_id() must be of the type resource, ' . \get_debug_type($resource) . ' given.');
        }
        return (int)$resource;
    }
}
