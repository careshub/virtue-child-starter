<?php
/**
 * Avoid double Bootstrap enqueues if CARES Data Tools is active.
 *
 * @since 1.0.1
 */
function virtue_child_check_bootstrap() {
	// If bootstrap has been enqueued by CARES Data Tools, remove the version that ships with Virtue.
	if ( wp_script_is( 'bootstrap-js', 'enqueued' ) ) {
		wp_dequeue_script( 'bootstrap' );
	}
}
add_action( 'wp_enqueue_scripts', 'virtue_child_check_bootstrap', 999 );

/**
 * Include code specific to sites that use the Sugar Calendar plugin.
 *
 * @since 1.1.0
 */
function maybe_include_sugar_calendar_filters() {
	$sc_version = defined( 'SC_PLUGIN_VERSION' ) ? SC_PLUGIN_VERSION : false;

	if ( $sc_version ) {
		include_once( plugin_dir_path( __FILE__ ) . 'functions-sugar-calendar.php' );
	}
}
add_action( 'init', 'maybe_include_sugar_calendar_filters' );