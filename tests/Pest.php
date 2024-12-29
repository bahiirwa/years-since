<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

function add_shortcode() {
    return true;
}

function add_action() {
    return true;
}

function shortcode_atts() {
    return true;
}

function esc_html__( string $text, string $domain ) {
    return $text;
}

function esc_html( string $text ) {
    return $text;
}

function __( string $text, string $domain ) {
    return $text;
}

function _n( string $single, string $plural, int $number, string $domain ) {
    return ( ( $number > 1 ) ? $plural : $single);
}
