<?php

require_once dirname( __FILE__, 3 ) . '/alar-years-since.php';

use Laurencebahiirwa\YearsSince; // Import the class
use function Laurencebahiirwa\shortcode_years_since as shortcode_years_since; // Import the class
use PHPUnit\Framework\TestCase;

it('tests invalid year format', function () {
	$atts = ['y' => 'invalid'];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBe('<p>Year must be 4 digits.</p>');
});

it('tests year in the future', function () {
	$atts = ['y' => date('Y') + 1];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBe('<p>Year cannot be greater than current year.</p>');
});

it('tests invalid month format', function () {
	$atts = ['m' => 'invalid'];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBe('<p>Month must be 2 digits.</p>');
});

it('tests month greater than 12', function () {
	$atts = ['m' => 13];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBe('<p>Month should be a value less than 12.</p>');
});

it('tests invalid day format', function () {
	$atts = ['d' => 'invalid'];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBe('<p>Day must be 2 digits.</p>');
});

it('tests day greater than 31', function () {
	$atts = ['d' => 32];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBe('<p>Days should be a value less than 31.</p>');
});

it('tests day greater than 28 for February', function () {
	$atts = ['m' => 2, 'd' => 29];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBe('<p>Days in Feb should be a value less than 28.</p>');
});

it('tests valid year, month, and day', function () {
	$atts = ['y' => 2023, 'm' => 10, 'd' => 15];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBeString('<p>Invalid date provided. Date cannot be greater than today.</p>');
});

it('tests text output with valid date', function () {
	$atts = ['y' => 2023, 'm' => 10, 'd' => 15, 'text' => 'true'];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBeString();
});

it('tests valid date minus text output', function () {
	$atts = ['y' => 2023, 'm' => 10, 'd' => 15, 'text' => 'false'];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBeInt();
	expect($result)->toBe(0);
});

it('tests invalid date greater than today', function () {
	$atts = ['y' => date('Y') + 1];
	$YearsSince = new YearsSince();
	$result = $YearsSince->shortcode_years_since($atts);
	expect($result)->toBe('<p>Year cannot be greater than current year.</p>');
});
