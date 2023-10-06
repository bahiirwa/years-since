<?php
/**
 * Plugin Name: Years Since
 * Plugin URI: https://omukiguy.com/
 * Description: Keep date time related texts relevant. "I have worked for x years." becomes outdated within a year. Years since keeps "x" current in your posts and allow your content to age well. 
 * Version: 1.3.3
 * Author: Laurence Bahiirwa
 * Author URI: https://omukiguy.com/
 * Tested up to: 6.0
 * Text Domain: years-since
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
namespace Laurencebahiirwa;

// Basic stop of brute force use.
defined('ABSPATH') || die('Unauthorized Access!');

/**
 * Implement the plugin. Let your post time travel.
 */
class YearsSince {
	/**
	 * A basic constructor.
	 */
	public function init() {
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
		return do_shortcode( $content );
	}

	/**
	 * A method to return the markup that replaces the shortcode.
	 * @param array $atts
	 * @return string
	 */
	public function shortcode_years_since($atts = []) {

		if ( isset($atts['y'])) {
			// Bail if year value is not 4 digits long.
			if (strlen($atts['y']) !== 4) {
				return __('Year must be 4 digits.', 'years-since');
			}

			// Bail if year is in the future.
			if ($atts['y'] > date('Y')) {
				return __('Year cannot be greater than current year.', 'years-since');
			}
		}

		if ( isset($atts['m']) ) {
			// Bail if year value is not 4 digits long.
			if (strlen($atts['m']) > 2) {
				return __('Month must be 2 digits.', 'years-since');
			}

			if ( (int)$atts['m'] > 12 ) {
				return __('Month less than 12.', 'years-since');
			}
		}

		if ( isset($atts['d']) ) {
			// Bail if year value is not 4 digits long.
			if (strlen($atts['d']) > 2) {
				return __('Day must be 2 digits.', 'years-since');
			}

			if ( (int)$atts['d'] > 31 ) {
				return __('Days must be less than 31.', 'years-since');
			}

			if ( (int)$atts['m'] == 2 && (int)$atts['d'] > 28 ) {
				return __('Days in Feb must be less than 28.', 'years-since');
			}
		}

		// Cast the year value as an integer.
		$y = (isset($atts['y']) && is_numeric($atts['y'])) ? (int)$atts['y'] : date('Y');

		// Ensure month and day values are integers, if set.
		$m = (isset($atts['m']) && is_numeric($atts['m'])) ? (int)$atts['m'] : date('m');
		$d = (isset($atts['d']) && is_numeric($atts['d'])) ? (int)$atts['d'] : date('d');

		$today      = new \DateTime(); // Create a DateTime object for today's date.
		$inputDate  = new \DateTime("$y-$m-$d"); // Returns'2023-10-15'
		$difference = date_diff($today,$inputDate);

		// Compare the two dates using comparison methods.
		if ($inputDate > $today) {
			return __('Invalid date provided. Date cannot be greater than today.', 'years-since');
		}

		// Return Weeks or days if less than a Week
		if ($difference->y < 1 && $difference->m < 1) {			
			// Return Weeks
			if ($difference->d/7 > 1) {
				return $this->string_return($difference->d/7, __('week', 'years-since'), __('weeks', 'years-since'), $defaults );
			}
			// Return days if less than a Week
			return $this->string_return($difference->d, __('day', 'years-since'), __('days', 'years-since'), $defaults );
		}
		// Return Months
		if ($difference->y < 1) {
			return $this->string_return($difference->m, __('month', 'years-since'), __('months', 'years-since'), $defaults );
		}
		// Otherwise, return years
		return $this->string_return($difference->y, __('year', 'years-since'), __('years', 'years-since'), $defaults );
	}

	/**
	 * Translate the string.
	 * Return Calculated time.
	 */
	public function string_return($time, $singular, $plural, $defaults ) {
		$str = sprintf(
			_n(
				'%d ' . $singular,
				'%d ' . $plural,
				$time,
				'years-since'
			),
			number_format_i18n($time)
		);
		$str = '<' . $defaults['html'] . '>' . $str . '</' . $defaults['html'] . '>';
		return $str;
	}
}

$years_since_init = new YearsSince();
$years_since_init->init();
