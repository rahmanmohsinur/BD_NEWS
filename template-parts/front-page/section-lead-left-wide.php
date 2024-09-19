<div class="row">
    <?php
    // Query for the latest articles
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 5, // Get the first 5 posts in total
        'cat'            => 167, // Specify category ID
    );
    $query = new WP_Query( $args );

    if ( $query->have_posts() ) :
        $counter = 0;

        while ( $query->have_posts() ) : $query->the_post();

            // Check if it's the first post
            if ( $counter === 0 ) : ?>
                <!-- Section for the lead post -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php the_post_thumbnail_url('large'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h3 class="card-title"><?php the_title(); ?></h3>
                            <p class="card-text"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <!-- Section for the rest of the posts -->
                <div class="col-md-6 col-lg-6">
                    <div class="card mb-4">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                        </div>
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