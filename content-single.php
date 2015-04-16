<?php
/**
 * @package topcat
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php  topcat_posted_on(); ?>
		</div><!-- .entry-meta -->
        <?php the_post_thumbnail('large-thumbnail'); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
        /*
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'topcat' ),
				'after'  => '</div>',
			) );
        */
        /*
        $args = array(
            'nextpagelink'     => '<span class="next">' . __('Next page') . '</span>',
            'previouspagelink' => '<span class="prev">' . __('Previous page') . '</span>'
        );
        wp_link_pages($args);
		*/
        ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php topcat_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
