<?php
/**
 * Include code specific to sites that use the Sugar Calendar plugin.
 *
 * @since 1.1.0
 */

/**
 * Don't use the sidebar on the Sugar Calendar "Events" page.
 *
 * @since 1.0.1
 */
function virtue_child_filter_sc_event_archive_sidebar( $show_sidebar ) {
	if ( function_exists( 'sc_doing_events' ) && sc_doing_events() ) {
		$show_sidebar = false;
	}
	return $show_sidebar;
}
add_filter( 'kadence_display_sidebar', 'virtue_child_filter_sc_event_archive_sidebar' );

/**
 * Strip the "Archives:" prefix from Virtue archives page title for the Sugar Calendar events archive.
 *
 * @since 1.0.1
 */
function virtue_child_sc_event_archive_titles( $title ) {
	$cpts = array( 'sc_event' );
	if ( is_post_type_archive( $cpts ) ) {
		$obj   = get_post_type_object( get_query_var( 'post_type' ) );
		$title = $obj->labels->name;
	}
	return $title;
}
add_filter( 'virtue_title', 'virtue_child_sc_event_archive_titles' );

/**
 * Change default order of events archive to be upcoming only (and ascending).
 * Must run before Sugar Calendar runs its own pre_get_posts check.
 *
 * @since 1.0.1
 */
function virtue_child_modify_sc_event_archive_order( $query = false ) {
	$cpts = array( 'sc_event' );
	// Setting this GET value here will cause SC to go to work in sc_modify_events_archive.
	if ( is_post_type_archive( $cpts ) && ! isset( $_GET[ 'event-display' ] ) ) {
		$_GET[ 'event-display' ] = 'upcoming';
	}

	return $query;
}
add_action( 'pre_get_posts', 'virtue_child_modify_sc_event_archive_order', 99 );

/**
 * Change the post meta output for Sugar Calendar events.
 *
 * @since 1.0.1
 */
function virtue_child_filter_sc_event_post_bits() {
	$cpts = array( 'sc_event' );
	if ( is_post_type_archive( $cpts ) || is_singular( $cpts ) ) {
		remove_action( 'virtue_single_post_header', 'virtue_post_header_meta', 30 );
		remove_action( 'virtue_single_post_before_header', 'virtue_single_post_headcontent', 10 );
		remove_action( 'virtue_single_post_before_header', 'virtue_single_post_meta_date', 20 );
		add_action( 'virtue_single_post_before_header', 'virtue_child_sc_event_post_meta_date', 20 );

	}
}
add_action( 'virtue_single_post_before', 'virtue_child_filter_sc_event_post_bits' );
add_action( 'virtue_sc_event_archive', 'virtue_child_filter_sc_event_post_bits' );

/**
 * Change the post date output for Sugar Calendar events.
 * Use the event date, nont the published date.
 *
 * @since 1.0.1
 */
function virtue_child_sc_event_post_meta_date() {
	$post_id    = get_the_ID();
	$start_date = sc_get_event_date( $post_id, false );
	?>
	<div class="postmeta updated color_gray">
		<div class="postdate bg-lightgray headerfont">
			<span class="postday"><?php echo date( 'j', $start_date ); ?></span>
			<?php echo date( 'M Y', $start_date ); ?>
		</div>
	</div>
	<?php
}