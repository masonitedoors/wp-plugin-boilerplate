<?php
/**
 * Provide the admin area view for the plugin
 *
 * @package    WP_Plugin_Boilerplate
 */

declare( strict_types = 1 );

// If this file is called directly, abort.
defined( 'WPINC' ) || die();

?>

<div class="wrap">

	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<p>This is where your plugin's settings live. Ideally, this page should be developed utilizing the <a href="https://codex.wordpress.org/Settings_API">WordPress Settings API</a>.</p>

</div>
