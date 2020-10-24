page

<?php
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
?>
    <article>

        <span> <?php the_time();?> <?php the_category();?></span>
        <h2>
            <?php the_title(); ?>
        </h2>
        <?php the_content(); ?>
    </article>

<?php
    endwhile; 
endif; 
?>