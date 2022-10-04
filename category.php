<?php get_header(); ?>
<main id="main" class="container container--full wrapper">
    <div class="wp-block-group alignfull has-background has-lgrey-background-color">
        <div class="wp-block-group__inner-container">
            <h1><?php single_term_title(); ?></h1>
                <p><?php if ( '' != get_the_archive_description() ) { echo esc_html( get_the_archive_description() ); } ?></p>
        </div>
    </div>
    <div class="alignwide blog__feed">
        <?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="blog__link wp-block-latest-posts" title="<?php the_title(); ?>">
                <div class="blog__excerpt">
                    <h2 class="blog__link-title"><?php the_title(); ?></h2>
                    
                        <p><?php echo get_excerpt(150); ?></p>
                        <span class="blog__cta button">Read More</span>
                </div>
                <figure class="blog__thumb">
                    <?php the_post_thumbnail(); ?>
                </figure>  
                    
            </a>
        <?php endwhile; endif?>
    </div>
    <nav class="pagination alignwide"><?php custom_pagination(); ?></nav>
</main>
<?php get_footer(); ?>