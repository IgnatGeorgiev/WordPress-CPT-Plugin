<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();
                the_title( '<h1 class="entry-title">', '</h1>' );
                echo '<h2>Description: </h2>';
                the_content(sprintf(__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title()));
                echo '<script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>';
                echo '<br>';
                echo '<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q='.get_post_meta($post->ID,"event_location",true).'&key=AIzaSyB6dUO7Ly56GD09VYeCuSK5e-rFg--zHuI" allowfullscreen></iframe>';
                echo '<br>';
                echo '<br>';
                echo 'Date: '.get_post_meta($post->ID, 'event_date', true); 
                echo '<br>';
                echo '<br>';
                echo '<a href="';
                echo "//".get_post_meta($post->ID, "event_url", true);
                echo '"'.'> Link </a>';
                echo '<br>';
                echo '<br>';
                echo '<div style="margin-bottom:10%;"title="Add to Calendar" class="addeventatc">Add to Calendar<span class="start">'.get_post_meta($post->ID, 'event_date', true).'</span> <span class="title">'.get_the_title($post->ID).'</span><span class="location">'.get_post_meta($post->ID,"event_location",true).'</span></div>';
                twentyseventeen_entry_footer();
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

                the_post_navigation( array(
                    'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
                    'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
                ) );

            endwhile; // End of the loop.
            ?>
            
        </main><!-- #main1 -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
