<?php
/*
Template Name: Home Page
*/
get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>

       <?php include_once(ABSPATH.'wp-admin/includes/plugin.php'); ?>
        <!-- check if nyto-services-cpt plugin is installed (it is required if we are going go use the Services feature)  -->
        <?php if ( is_plugin_active( 'nyto-services-cpt/nyto_services_cpt.php' ) ) {
			?>
            <!-- Display custom posts of type service -->
            <?php $loop = new WP_Query( array( 'post_type' => 'service' ) ); ?>
            <?php
			if ( $loop->found_posts > 0 ) {
					$service_class = '';
				if ( $loop->found_posts <= 4 ) {
					$service_class = round( 100 / $loop->found_posts );
				}
			?>
					<!-- begin services row -->
					<section class="inline-block-center services_section">
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                <div class=<?php echo 'perc'. "$service_class"; ?>> <!-- begin services column wrapper -->
                                    <?php  echo '<h2 class="service-title">' . get_the_title().' </h2>' ; ?>
                                    <span class="entry-content service-content">
                                                    <?php the_content(); ?>
                                                </span>
                                </div> <!-- end services column wrapper -->
                            <?php endwhile; ?>
					</section <!-- end services row -->
			<?php } //closing if services exists ?>
	<?php } //closing "if ( is_plugin_active..."  ?>
    </main>
</div><!-- #primary -->
<?php get_footer(); ?>
