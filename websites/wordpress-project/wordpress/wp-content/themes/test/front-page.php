<?php get_header(); ?>

<h1> front-page.php</h1>

<?php
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
?>
    <article>

        <span> <?php the_time();?> <?php the_category();?></span>
        <h2>
            <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
        </h2>
        <?php get_extended(the_content('Pokaz wiecej')); ?>
    </article>

<?php
    endwhile; 
endif; 
?>

<?php get_footer(); ?>
