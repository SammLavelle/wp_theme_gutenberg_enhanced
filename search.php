<?php get_header(); ?>
<main id="main" class="container container--full wrapper">
    <div class="wp-block-group alignfull has-background has-lgrey-background-color">
        <div class="wp-block-group__inner-container">
            <h1 class="entry-title" itemprop="name"><?php printf( esc_html__( 'Search Results for: %s', 'blankslate' ), get_search_query() ); ?></h1>
            <?php if ( have_posts() ): 
                 get_search_form(); 
            endif; ?>
        </div>
    </div>
    <?php if ( have_posts() ):  ?>
        <div class="alignwide blog__feed blog__feed--search">
            <?php while ( have_posts() ) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="blog__link wp-block-latest-posts" title="<?php the_title(); ?>">
                    <div class="blog__excerpt">
                        <h2 class="blog__link-title"><?php the_title(); ?></h2>
                        
                            <p><?php echo get_excerpt(300); ?></p>
                            <span class="blog__cta button">Read More</span>
                    </div>
                    <?php if(get_the_post_thumbnail()){ ?>
                        <figure class="blog__thumb">
                        
                            <?php the_post_thumbnail(); ?>
                        
                        </figure>  
                    <?php };  ?>
                        
                </a>
            <?php endwhile;  ?>
        </div>
        <nav class="pagination alignwide"><?php custom_pagination(); ?></nav>
    <?php else : ?>
        <p><?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'blankslate' ); ?></p>
        <?php get_search_form(); ?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>