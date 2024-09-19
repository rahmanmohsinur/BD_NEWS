<?php
// Include the header template
get_header();
?>


<div class="container">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8 col-md-12 my-4">
            <?php
            // Start the WordPress loop to display the current post
            if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>

                <!-- Current Post Content -->
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

                    <footer class="entry-footer pb-5">
                        <?php the_category(); ?>
                        <?php the_tags(); ?>
                    </footer>
                </article>
                <!-- /Current Post Content -->

                <?php
                endwhile;
            else :
                echo '<p>No content found</p>';
            endif;
            ?>

            <!-- Container for the new posts to be loaded dynamically -->
            <div id="post-container"></div> <!-- New posts will be appended here -->

            <!-- Optional: add a loader here if needed -->
            <div id="loader" style="display: none; text-align: center;">
                <!-- Bootstrap Spinner -->
                <div class="spinner-grow text-muted"></div>
                <div class="spinner-grow text-dark"></div>
                <div class="spinner-grow text-muted"></div>
            </div>

        </div>

        <!-- Sidebar Area -->
        <div class="col-lg-4 col-md-12 d-none d-lg-block d-xl-block">
            <?php get_sidebar(); // Include the sidebar template ?>
        </div>
    </div>
</div>


<?php
// Include the footer template
get_footer();
?>

