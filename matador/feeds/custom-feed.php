<?php
/**
 * Template : Custom XML Feed Loop
 *
 * Override this template by creating a copy with the same name in [theme-folder]/matador/feeds/custom.php
 *
 * @see
 *
 * @link        http://matadorjobs.com/
 * @since       2.0.0
 *
 * @package     Matador Jobs Pro - Jobs Syndication Feeds Extension
 * @subpackage  Templates / Loops
 * @author      Jeremy Scott, Paul Bearne
 * @copyright   (c) 2017-2023 Matador Software, LLC
 *
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License version 3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Defined Before Includes:
 *
 * @var string $feed         The Feed name.
 * @var string $last_updated The date and time in MYSQL format of the last update on the post type (feed)
 * @var string $publisher    The publisher or company name, filterable on `matador_extension_feeds_{$feed_name}_publisher`
 */
?>
<source>
	<publisher><?php echo esc_html( $publisher ); ?></publisher>
	<publisherurl><?php echo get_bloginfo_rss( 'url' ); ?></publisherurl>
	<lastBuildDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', $last_updated, false ); ?></lastBuildDate>
	<?php
	while ( have_posts() ) :

		the_post();

		if ( matador_feeds_should_skip_job( $feed ) ) {

			continue;
		}

		matador_get_template( $feed . '-each.php', [ 'feed' => $feed, 'publisher' => $publisher ], 'feeds/each', true );

	endwhile;

	/**
	 * Feed Extras Loop
	 *
	 * Add additional content to the feed loop after job items. Dynamically named for each feed.
	 *
	 * @wordpress-action
	 *
	 * @since 2.0.0
	 */
	do_action( "matador_extension_feeds_{$feed}_loop" );
	?>
</source>
