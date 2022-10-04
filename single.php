<?php get_header(); 
if ( have_posts() ): while ( have_posts() ) : the_post();?>
<main id="main" class="layout--has-sidebar container container--wide">
    <header class="layout__header wrapper">
        <h1><?php the_title(); ?></h1>
    </header>
    <article class="layout__main wrapper">
        <?php the_content(); ?>
    </article>
    <aside class="layout__aside wrapper">
        <?php if ( is_active_sidebar( 'post-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'post-sidebar' ); ?>
        <?php endif; ?>
    </aside>
</main> 
<?php endwhile; endif?>
<?php get_footer(); ?>