<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package topcat
 */

if ( ! function_exists( 'topcat_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function topcat_paging_nav() {
    global $wp_query, $wp_rewrite;

    // Don't print empty markup if there's only one page.
    if ( $wp_query->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'format'   => $format,
        'total'    => $wp_query->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => __( '<i class="fa fa-arrow-left fa-4"></i> Previous', 'topcat' ),
        'next_text' => __( 'Next <i class="fa fa-arrow-right fa-4"></i>', 'topcat' ),
    ) );

    if ( $links ) :

        ?>
        <nav class="navigation paging-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentyfourteen' ); ?></h1>
            <div class="pagination loop-pagination">
                <?php echo $links; ?>
            </div><!-- .pagination -->
        </nav><!-- .navigation -->
    <?php
    endif;
}
endif;

if ( ! function_exists( 'topcat_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function topcat_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>

	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'topcat' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<i class="fa fa-arrow-left fa-3"></i>&nbsp;&nbsp;
<span class="meta-nav">Previous</span><br />&nbsp;%title', 'Previous post link', 'topcat' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '<span class="meta-nav">Next</span>&nbsp;&nbsp;<i class="fa fa-arrow-right fa-3"></i><br />%title&nbsp;', 'Next post link',     'topcat' ) );
			?>
		</div>
	</nav>

	<?php
}
endif;

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */

if ( ! function_exists( 'topcat_posted_on' ) ) :

function topcat_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'topcat' ),
		'<i class="fa fa-calendar"></i>&nbsp;&nbsp;<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" >' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( '<i class="fa fa-user"></i>&nbsp;&nbsp;'.'by: %s', 'post author', 'topcat' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

    if ( 'post' == get_post_type() ) {
        echo '<span class="posted-on">' . $posted_on . '</span>|&nbsp;&nbsp;<span class="byline"> ' . $byline . '</span>|&nbsp;&nbsp;' ;
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( __( ', ', 'topcat' ) );
        if ( $categories_list && topcat_categorized_blog() ) {
            echo  '<i class="fa fa-th-list"></i>&nbsp;&nbsp;<span class="byline">'. __( 'Category: ', 'topcat' ) . '</span>' . '<span class="cat-links">'.  $categories_list . '</span>';
        }

        echo edit_post_link( __( ' Edit ', 'topcat'), '|&nbsp;&nbsp;<i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;<span class="edit">', '</span>');
    }
}
endif;


if ( ! function_exists( 'topcat_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function topcat_entry_footer() {
	if ( 'post' == get_post_type() ) {
        $posttags = get_the_tags();
        echo '<div class="tags-links">Tags:<span>&nbsp;&nbsp;';
        if ($posttags) {
            foreach($posttags as $tag) {
                echo '<i class=" fa fa-tag"></i>&nbsp;&nbsp' .
                       '<a  href="' . get_tag_link($tag->term_id) . '">' .
                       $tag->name . '</a>&nbsp;&nbsp' ;
            }
        }
        echo '</span><div>';
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'topcat' ), __( '1 Comment', 'topcat' ), __( '% Comments', 'topcat' ) );
		echo '</span>';
	}

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function topcat_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'topcat_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'topcat_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so topcat_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so topcat_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in topcat_categorized_blog.
 */
function topcat_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'topcat_categories' );
}
add_action( 'edit_category', 'topcat_category_transient_flusher' );
add_action( 'save_post',     'topcat_category_transient_flusher' );
