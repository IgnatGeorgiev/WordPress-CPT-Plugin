<?php
// single-events.php
get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area kur">
        <main id="main" class="site-main" role="main">
            <?php  while ( have_posts() ) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <h4>
        <?php
        $event_location = get_post_meta(get_the_ID(), 'event_location', true);
        echo esc_html($event_location);
        ?>
    </h4>
    <?php the_content(); ?>
<?php endwhile; ?>
        </main>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer();