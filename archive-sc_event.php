<?php
/**
 * Events Archive for Event Organizer
 *
 * @package Virtue Theme
 */

get_header();
?>
<div class="wrap contentclass" role="document">

<?php
	do_action( 'kt_afterheader' );
	do_action( 'virtue_sc_event_archive' );

	$postclass = 'postlist fullwidth';

	/**
	* @hooked virtue_page_title - 20
	*/
	do_action( 'virtue_page_title_container' );
	?>

		<div id="content" class="container">
			<div class="row">
				<div class="main <?php echo esc_attr( virtue_main_class() ); ?> <?php echo esc_attr( $postclass );?>" role="main">

				<?php if ( ! have_posts() ) : ?>
					<div class="alert">
						<?php esc_html_e( 'Sorry, no results were found.', 'virtue' ); ?>
					</div>
					<?php get_search_form();
				endif;

				while (have_posts()) : the_post();
					get_template_part( 'templates/content', get_post_type() );
				endwhile;

				/**
				* @hooked virtue_pagination - 10
				*/
				do_action( 'virtue_pagination' );
				?>

				</div><!-- /.main -->

			</div><!-- /.row-->
			<?php do_action( 'kt_after_content' ); ?>
		</div><!-- /.content -->
	</div><!-- /.wrap -->
<?php
get_footer();
