<article <?php post_class(); ?> itemscope="" itemtype="https://schema.org/BlogPosting">
	<?php 
	/**
	* @hooked virtue_single_post_headcontent - 10
	* @hooked virtue_single_post_meta_date - 20
	*/
	do_action( 'virtue_single_post_before_header' );
	?>
	<header>
		<a href="<?php the_permalink() ?>">
			<h1 class="entry-title" itemprop="name headline">
				<?php the_title(); ?>
			</h1>
		</a>
		<?php //get_template_part('templates/entry', 'meta-subhead'); ?>
	</header>
	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
	</div>
</article>

