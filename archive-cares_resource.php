<?php
global $virtue, $virtue_sidebar;
if ( isset( $virtue[ 'blog_archive_full' ] ) && 'full' === $virtue[ 'blog_archive_full' ] ) {
	$summery    = 'full';
	$postclass  = 'single-article fullpost';
} else {
	$summery 	= 'normal';
	$postclass 	= 'postlist';
}
$virtue_sidebar = true;
/**
* @hooked virtue_page_title - 20
*/
do_action( 'virtue_page_title_container' );
?>

<div id="content" class="container">
	<div class="row">
		<div class="main <?php echo esc_attr( virtue_main_class() ); ?>  <?php echo esc_attr( $postclass );?>" role="main">

		<?php if ( ! have_posts() ) : ?>
			<div class="alert">
				<?php esc_html_e( 'Sorry, no results were found.', 'virtue' ); ?>
			</div>
		<?php
		endif;
		?>

		<div id="cares-resources-library" class="resources-library hide-during-load" v-bind:class="['mounted']">Resources Library</div>

		</div><!-- /.main -->
