<?php
/**
 * Plugin Name: Custom feed example
 * Plugin URI: http://{{placeholder.plugin_website}}/
 * Description: Generates numerous syndication feeds to the specifications of the job board aggregators' standards.
 * Author: {{placeholder.author}}
 * Author URI: {{placeholder.author_url}}
 * Version: {{placeholder.version}}
 * Text Domain: custom-syndication-feeds
 * Domain Path: /languages
 *
 * This software is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation, either version 3 of
 * the License, or any later version.
 *
 * This software is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this software. If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * Filter the locate template function for the feed you are added
 * You need to 2 check one the root and one the each
 *
 * You don't need this function if you add this code to your theme functions.php file
 */
add_filter( 'matador_locate_template', static function ( $template, $name, $subdirectory ) {

	if( "custom-feed.php" === $name && file_exists( __DIR__ . "/matador/feeds/custom-feed.php" ) ){

		return __DIR__. "/matador/feeds/custom-feed.php";
	}
	if( "custom-feed-each.php" === $name && file_exists( __DIR__ . "/matador/feeds/each/custom-feed-each.php" ) ){

		return __DIR__ . "/matador/feeds/each/custom-feed-each.php";
	}

	return $template;
}, 10, 3 );

/**
 * Add your custom feed to the list of available feeds
 */
add_filter( 'matador_extension_feeds_registered_feeds',  static function ( $feeds ) {

	$feeds['custom-feed'] = [ // feed ID need to match the template name
		'name'        => 'Custom Feed', // freindly feed label
		'description' => __( 'Example custom feed.', 'custom-syndication-feeds' ), // feed description
		'info_link'   => 'https://domain.com/', // optional link to more info about the feed
		'docs_link'   => 'https://domain.com/docs', // optional link to doc about the feed
	];

	return $feeds;
} );