<?php
define('ABSPATH', true );
require_once __DIR__ . '/../../alar-years-since.php';

use Laurencebahiirwa\YearsSince;

it('returns correct years since for a given date', function ( $dates, $response) {
    $yearsSince = new YearsSince();
    $yearsSince->init();

    $result = strip_tags($yearsSince->shortcode_years_since($dates, new DateTime('2024-04-16') ) );
    expect($result)->toBe($response);
})->with(
    [
        [ ['y' => 2000], '24 years'],
        [ ['y' => 2000, 'm' => 1 ], '24 years 3 months'],
        [ ['y' => 2000, 'm' => 3 ], '24 years 1 month'],
        [ ['y' => 2000, 'm' => 4 ], '24 years'],
        [ ['y' => 2000, 'm' => 1, 'd' => 1], '24 years 3 months 15 days'],
        [ ['y' => 3000], 'Year cannot be greater than current year.'],
        [ ['y' => 2000, 'm' => 13], 'Month should be a value less than 12.'],
        [ ['y' => 2000, 'm' => 2, 'd' => 30], 'Days in Feb should be a value less than 29.'],
    ]
);
