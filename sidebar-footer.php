<?php
/**
 * Created by PhpStorm.
 * User: LPAC006013
 * Date: 04/12/14
 * Time: 2:54 PM
 */
?>
<!-- Custom sidebar code begin  -->
        <?php
		if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
			return;
		}
		?>

<div id="sidebar-footer" class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
</div><!-- #secondary -->
<!-- Custom sidebar code end  -->
