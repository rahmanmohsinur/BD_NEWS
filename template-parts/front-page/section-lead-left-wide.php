
<div class="row h-100">
    <?php
    // Query for the latest articles
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3, // Get the first 5 posts in total
        'cat'            => 167, // Specify category ID for Bangladesh
    );
    $query = new WP_Query( $args );

    if ( $query->have_posts() ) :
        $counter = 0;

        while ( $query->have_posts() ) : $query->the_post();

            // Check if it's the first post
            if ( $counter === 0 ) : ?>
                <!-- Section for the first post -->
                <div class="col-lg-4 col-xl-12 mb-4">
                    <div class="card img-fluid h-100">
                    <a href="<?php the_permalink(); ?>" class="">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php the_post_thumbnail_url('large'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h3 class="card-title"><?php the_title(); ?></h3>
                        <p class="card-text">
                        <?php 
                            // the_excerpt();
                            // This function is from function.php file, you can edit the function in there
                            echo get_excerpt(900); ?>
                        </p>
                        </div>
                    </a>
                    </div>
                </div>
            <?php else : ?>
                <!-- Section for the rest of the posts -->
                <div class="col-md-6 col-lg-4 col-xl-6 mb-4">
                    <div class="card img-fluid h-100">
                    <a href="<?php the_permalink(); ?>" class="">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php the_post_thumbnail_url('large'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h4 class="card-title">
                                <?php //the_title(); 
                                echo wp_trim_words( get_the_title(), 12, '' ); ?></h4>
                        <p class="card-text">
                        <?php 
                            // the_excerpt();
                            // This function is from function.php file, you can edit the function in there
                            echo get_excerpt(300); ?>
                        </p>
                        </div>
                    </a>
                    </div>
                </div>
            <?php endif;

            $counter++;

        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No articles found.</p>';
    endif;
    ?>
</div>