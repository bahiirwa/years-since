=== Years Since ===
Contributors: laurencebahiirwa
Tags: date, update, updater, time, span, year, automated, references
Donate link: https://paypal.me/laurencebahiirwa
Requires at least: 4.9.0
Tested up to: 6.0
Requires PHP: 5.6
Stable tag: 1.3.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Keep date time related texts relevant. "I have worked for x years." becomes outdated within a year. Years since keeps "x" current in your posts and allow your content to age well. 

== Description ==
Keep date time related texts relevant. "I have worked for x years." becomes outdated within a year. Years since keeps "x" current in your posts and allow your content to age well. 

== Usage ==
A year must be provided in your text by the attribute "y" such as ``[years-since y=2012]``.
As an option, Months by referencing "m" and day by using "d". Months and day default to "1" if not added in the shortcode.

For example, on an "About" page text, you might have something like:

> We've worked remotely for ``[years-since y=2012]``, which has allowed the team to spend more time traveling and spending time with family.
Or, if you wanted to update a time span on a particular anniversary, you could do something like:
``I'm [years-since y=1990 m=5 d=16] old.``

== Installation ==
* Navigate to your plugins admin page.
* Search for "years since" and download the plugin.
* Install using the plugin admin interface.

== Frequently Asked Questions ==

= Does it work with the Block Editor/Gutenberg? =
Yes.

= Does it work with ClassicPress? =
Yes. This will still work even if you revert to the Classic Editor seamlessly.

= How can I contribute? =
You can raise lots of [issues](https://github.com/bahiirwa/years-since/) here and also make some [Pull Requests through github](https://github.com/bahiirwa/years-since/)

== Upgrade Notice ==

== 1.3.2 ==
- Fix `or` to `||`

== 1.3.1 ==
* Namespace the plugin to avoid PHP conflicts.
* Fix the breaking html when [years-since-gb] is used.
* Test WP version compatibility for 5.6.

== 1.3.0 ==
* Add functionality to allow for days, months, weeks instead of 0 years when time is less than a year.

== 1.2.0 ==
* Add Gutenberg support

== 1.1.0 ==
* Add Gutenberg note to readme.

== 1.0.1 ==
* Translate returned errors.
* Shortcode parameter to suppress "year" and "years" text.

== 1.0.0 ==
* Initial creation.