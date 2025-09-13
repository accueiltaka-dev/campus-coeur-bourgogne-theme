<?php
get_header(); ?>

<main id="site-content" style="padding:40px; max-width:1200px; margin:auto;">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h1 class="page-title"><?php the_title(); ?></h1>
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile;
    else :
        echo '<p>Aucun contenu disponible pour l’instant.</p>';
    endif;
    ?>
</main>

<?php
get_footer();
