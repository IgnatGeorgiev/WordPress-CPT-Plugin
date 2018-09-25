<?php
/**
 * The template for displaying archive pages
 */

get_header(); ?>

<div class="wrap">

	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', get_post_format() );
				echo '<script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>';
				echo '<br>';
				echo '<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q='.get_post_meta($post->ID,"event_location",true).'&key=AIzaSyB6dUO7Ly56GD09VYeCuSK5e-rFg--zHuI" allowfullscreen></iframe>';
				
				echo '<br>';
				echo '<br>';
		        echo get_post_meta($post->ID, 'event_date', true); 
		        echo '<br>';
		        echo '<br>';
		        echo '<a href="';
		        echo "//".get_post_meta($post->ID, "event_url", true);
		        echo '"'.'> Link </a>';
				echo '<br>';
				echo '<br>';
				echo '<div title="Add to Calendar" class="addeventatc">
    Add to Calendar
    <span class="start">'.get_post_meta($post->ID, 'event_date', true).
'</span>
    <span class="title">'.get_the_title($post->ID).'</span>
    <span class="location">'.get_post_meta($post->ID,"event_location",true).'</span>
</div>';


			endwhile;

			the_posts_pagination( array(
				'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
			) );

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
