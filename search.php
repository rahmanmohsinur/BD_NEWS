<?php 
get_header();

// Custom query to control the number of search results
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; // Check for pagination
$args = array(
    's'              => get_search_query(),
    'posts_per_page' => 12, // Change this number to the desired posts per page
    'paged'          => $paged
);

$custom_query = new WP_Query( $args ); ?>

<div class="container my-5">
    <h1 class="text-center pb-4">
        <?php 
        /* Translators: %s is the search query */
        printf( esc_html__( ' "%s" - এর জন্য অনুসন্ধানকৃত ফলাফল', 'textdomain' ), '<span>' . get_search_query() . '</span>' ); 
        ?>
    </h1>

    <?php if ( $custom_query->have_posts() ) : ?>
        <div class="row">
            <?php
            // Start the Loop.
            while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="card h-100">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-top' ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <p class="card-text">
                                <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                <small class="text--muted">
                                    <a href="<?php the_permalink(); ?>" class="">বিস্তারিত &#8594;</a>
                                </small>
                            </p>
                        </div>
                        <div class="card-footer text--center">
                            <div class="float-left pub pub-date pb-2">
                                <small class="text--muted"><i class="far fa-clock"></i>
                                    <?php echo BD_NEWS_article_published_time(); ?>
                                </small>
                            </div>
                            <div class="float-right pub pub-date pb-2">
                                <small class="text--muted"><i class="far fa-eye"></i>
                                    <?php echo BD_NEWS_number((int) get_post_meta(get_the_ID(), 'post_views_count', true)) . ' জন পড়েছেন'; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination text-center">
            <?php
            // Display pagination using Bootstrap classes.
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '&laquo;  পূর্ববর্তী ', 'textdomain' ),
                'next_text' => __( 'পরবর্তী  &raquo;', 'textdomain' ),
                'before_page_number' => '<span class="btn btn-outline-secondary mx-1">',
                'after_page_number'  => '</span>',
                'screen_reader_text' => __( 'Posts navigation' ),
                'class' => 'mx-auto', // Add a class to the pagination container if needed
                'ul_class' => 'pagination', // Add classes to the <ul> element
            ) );
            ?>
        </div>
        
      
    <?php 
    wp_reset_postdata();
    else : ?>
        <div class="alert alert-warning" role="alert">
            <?php esc_html_e( 'দুঃখিত, কোন পোস্ট আপনার মানদণ্ডের সাথে মেলেনি।', 'textdomain' ); ?>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>

