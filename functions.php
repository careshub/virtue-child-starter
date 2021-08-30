<?php
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.1
 */
function virtue_child_arc_scripts() {
	// Include the needed js file.
	// wp_enqueue_script( 'virtue-child-arc-base-scripts', get_stylesheet_directory_uri( '/js/public.js' ), array( 'jquery' ), '1.0.1', true );
}
add_action( 'wp_enqueue_scripts', 'virtue_child_arc_scripts' );

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
 * Add the Google "noscript" tag immediately after the opening of the body element.
 *
 * @since 1.0.0
 *
 */
function cares_virt_child_add_google_tag_manager_noscript_tag() {
	?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=ACCOUNT_ID_GOES_HERE"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php
}
// add_action( 'virtue_after_body', 'cares_virt_child_add_google_tag_manager_noscript_tag' );

function cares_virt_child_add_google_tag_manager_script() {
	?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','ACCOUNT ID GOES HERE');</script>
	<!-- End Google Tag Manager -->
	<?php
}
// add_action( 'wp_head', 'cares_virt_child_add_google_tag_manager_script' );


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