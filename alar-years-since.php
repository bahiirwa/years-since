<?php
/**
 * Plugin Name: Years Since
 * Plugin URI: https://omukiguy.com/
 * Description: Let your post time travel. Texts like "I have worked for x years in web dev" become outdated within a year. Years since keeps the date related texts current in your posts and allow your content to age well. 
 * Version: 1.3.1
 * Author: Laurence Bahiirwa
 * Author URI: https://omukiguy.com/
 * Tested up to: 5.6.0
 * Text Domain: years-since
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
namespace Laurencebahiirwa;

// Basic stop of brute force use.
defined('ABSPATH') or die('Unauthorized Access!');

/**
 * Implement the plugin. Let your post time travel.
 */
class YearsSince {
	/**
	 * A basic constructor.
	 */
	public function __construct() {
		add_shortcode('years-since', array($this, 'shortcode_years_since'));
		add_shortcode('years-since-gb', array($this, 'shortcode_years_since_gb'));
		add_action('plugins_loaded',  array($this, 'load_plugin_textdomain'));
	}

	/**
	 * Load gettext translate for text domain.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function load_plugin_textdomain() {
		load_plugin_textdomain('years-since');
	}

	/**
	 * A method to return the markup that replaces the shortcode.
	 * @param array $atts
	 * @return string
	 */
	public function shortcode_years_since_gb($atts, $content = null) {
		return '<p>' . do_shortcode($content) . '</p>';
	}

	/**
	 * Translate the string.
	 * Return Calculated time.
	 */
	public function string_return($time, $singular, $plural) {
		$str = sprintf(
			_n(
				'%d ' . $singular,
				'%d ' . $plural,
				$time,
				'years-since'
			),
			number_format_i18n($time)
		);
		return $str;
	}

	/**
	 * A method to return the markup that replaces the shortcode.
	 * @param array $atts
	 * @return string
	 */
	public function shortcode_years_since($atts) {
		// Bail if no year argument was passed.
		if (!isset($atts['y'])) {
			return __('Year is required.', 'years-since');
		}
		// Bail if year value is not numeric.
		if (!is_numeric($atts['y'])) {
			return __('Year must be numeric.', 'years-since');
		}
		// Bail if year value is not 4 digits long.
		if (strlen($atts['y']) !== 4) {
			return __('Year must be 4 digits.', 'years-since');
		}
		// Bail if year is in the future.
		if ($atts['y'] > date('Y')) {
			return __('Year cannot be greater than current year.', 'years-since');
		}
		// Cast the year value as an integer.
		$y = (int)$atts['y'];
		// Ensure month and day values are integers, if set.
		$m = (isset($atts['m'])) ? (int)$atts['m'] : 1;
		$d = (isset($atts['d'])) ? (int)$atts['d'] : 1;
		// Calculate span between start date and today.
		$difference = date_diff(date_create("$y-$m-$d"), date_create());
		// If only the number is needed, return it here.
		if (isset($atts['text'])) {
			return $difference->y;
		}
		// Return Weeks or days if less than a Week
		if ($difference->y < 1 && $difference->m < 1) {			
			// Return Weeks
			if ($difference->d/7 > 1) {
				return $this->string_return($difference->d/7, __('week', 'years-since'), __('weeks', 'years-since'));
			}
			// Return days if less than a Week
			return $this->string_return($difference->d, __('day', 'years-since'), __('days', 'years-since'));
		}
		// Return Months
		if ($difference->y < 1) {
			return $this->string_return($difference->m, __('month', 'years-since'), __('months', 'years-since'));
		}
		// Otherwise, return years
		return $this->string_return($difference->y, __('year', 'years-since'), __('years', 'years-since'));
	}
}
new YearsSince;