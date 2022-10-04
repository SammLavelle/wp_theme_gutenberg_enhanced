<?php get_header(); 
if ( have_posts() ): while ( have_posts() ) : the_post();
 ?>
<main id="main" class="container container--full wrapper">
	<?php the_content(); ?>
</main>
<?php endwhile; endif?>
<?php get_footer(); ?>