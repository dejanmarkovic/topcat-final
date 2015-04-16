<?php
/**
 * @package topcat
 */
?>
<?php
 $post_class='';
 if(is_sticky())
 {
     $post_class = 'sticky-post';
 }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php topcat_posted_on(); ?>
		</div><!-- .entry-meta -->
            <?php the_post_thumbnail('small-thumbnail'); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */

           /*
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'topcat' ), 
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
           */
        the_excerpt();

		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'topcat' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //topcat_entry_footer(); ?>
        <?php echo '<a href="' . get_permalink() . '" title="' . __('Read More ', 'topcat') . get_the_title() . '" >Read More&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-right"></i></a>'; ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
