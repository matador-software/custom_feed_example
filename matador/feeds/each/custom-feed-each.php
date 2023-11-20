<?php
/**
 * Template : Custom XML Feed Each
 *
 * Override this template by creating a copy with the same name in [theme-folder]/matador/feeds/each/custom-each.php
 *
 * @link        http://matadorjobs.com/
 * @since       2.0.0
 *
 * @package     Matador Jobs Pro - Jobs Syndication Feeds Extension
 * @subpackage  Templates / Each
 * @author      Jeremy Scott, Paul Bearne
 * @copyright   (c) 2017-2023 Matador Software, LLC
 *
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License version 3
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Defined Before Includes:
 *
 * @var string $feed         The Feed name.
 * @var string $last_updated The date and time in MYSQL format of the last update on the post type (feed)
 * @var string $publisher    The publisher or company name, filterable on `matador_extension_feeds_{$feed_name}_publisher`
 */

$data = matador_feeds_get_the_job_data( $feed );
?>
<job>

	<title>cUSTOM<?php matador_feeds_xml( get_the_title_rss(), [ 'esc_xml' => false ] ); ?></title>

	<date><?php matador_feeds_xml( mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'D, d M Y H:i:s +0000', true ), false ), [ 'esc_xml' => false ] ); ?></date>

	<expirationDate><?php matador_feeds_xml( matador_get_the_job_meta( 'dateEnd', get_the_ID(), $feed ) ); ?></expirationDate>

	<description><?php matador_feeds_xml( get_the_content_feed() ); ?></description>

	<?php if ( matador_get_the_job_bullhorn_id() ) : ?>
		<referencenumber><?php matador_feeds_xml( matador_get_the_job_bullhorn_id() ); ?></referencenumber>
	<?php endif; ?>

	<url><?php matador_feeds_xml( matador_feeds_get_the_job_link( get_the_ID(), $feed ) ); ?></url>

	<?php if ( ! empty( $data['hiringOrganization']['name'] ) ) : ?>
		<company><?php matador_feeds_xml( $data['hiringOrganization']['name'] ); ?></company>
	<?php endif; ?>

	<?php if ( ! empty( $data['jobLocation']['address']['streetAddress'] ) ) : ?>
		<streetaddress><?php matador_feeds_xml( $data['jobLocation']['address']['streetAddress'] ) ?></streetaddress>
	<?php endif ?>

	<?php if ( ! empty( $data['jobLocation']['address']['addressLocality'] ) ) : ?>
		<city><?php matador_feeds_xml( $data['jobLocation']['address']['addressLocality'] ); ?></city>
	<?php endif; ?>

	<?php if ( ! empty( $data['jobLocation']['address']['addressRegion'] ) ) : ?>
		<state><?php matador_feeds_xml( $data['jobLocation']['address']['addressRegion'] ); ?></state>
	<?php endif; ?>

	<?php if ( ! empty( $data['jobLocation']['address']['postalCode'] ) ) : ?>
		<postalcode><?php matador_feeds_xml( $data['jobLocation']['address']['postalCode'] ); ?></postalcode>
	<?php endif; ?>

	<?php if ( ! empty( $data['jobLocation']['address']['addressCountry'] ) ) : ?>
		<country><?php matador_feeds_xml( $data['jobLocation']['address']['addressCountry'] ); ?></country>
	<?php endif; ?>

	<?php if ( matador_feeds_get_type( get_the_ID(), $feed ) ) : ?>
		<jobtype><?php matador_feeds_xml( matador_feeds_get_type( get_the_ID(), $feed ) ); ?></jobtype>
	<?php endif; ?>

	<?php if ( matador_get_the_job_meta( 'salary_string', get_the_ID(), $feed ) ) : ?>
		<salary><?php matador_feeds_xml( matador_get_the_job_meta( 'salary_string', get_the_ID(), $feed ) ); ?></salary>
	<?php endif; ?>

	<?php if ( matador_feeds_get_location_requirements() ) : ?>
		<?php
		/**
		 * Values are mapped with filter at
		 * @see matador_extension_feeds_indeed_location_requirements() in /includes/helpers/indeed-helper.php
		 */
		?>
		<remotetype><?php matador_feeds_xml( matador_feeds_get_location_requirements() ); ?></remotetype>
	<?php endif; ?>

	<?php if ( matador_feeds_get_terms() ) : ?>
		<category><?php matador_feeds_xml( matador_feeds_get_terms() ); ?></category>
	<?php endif; ?>

	<?php if ( matador_feeds_get_experience() ) : ?>
		<experience><?php matador_feeds_xml( matador_feeds_get_experience() ); ?></experience>
	<?php endif; ?>

	<?php
	/**
	 * Feed Extras Each
	 *
	 * Add additional content to the feed each job items. Dynamically named for each feed.
	 *
	 * @wordpress-action
	 *
	 * @since 2.0.0
	 *
	 * @param int $wpid The ID of the WordPress job posting post
	 */
	do_action( "matador_extension_feeds_{$feed}_each", get_the_ID() );
	?>
</job>