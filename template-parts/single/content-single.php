
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div id="printableArea" class="blog-post">
        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-meta">
                <?php the_date(); ?> by <?php the_author(); ?>
            </div>
        </header>
                            
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="article_image">
                <figure class="figure" >
                    <?php the_post_thumbnail('large-thumbnail', array('class' => 'img-fluid')); ?>
                </figure>
            </div><!-- /article_image -->
        <?php } ?>

        <div class="article-content py-4">
            <?php the_content(); ?>
        </div>
    </div>

    <footer class="entry-footer">
        <?php the_category(); ?>
        <?php the_tags(); ?>
    </footer>
</article>




