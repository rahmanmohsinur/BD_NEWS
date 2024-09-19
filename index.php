<?php get_header(); ?>

<main id="main" role="main" class="container my-5">
    <?php if ( have_posts() ) : ?>
        <div class="row">
            <?php
            // Start the loop to display posts
            while ( have_posts() ) : the_post(); ?>
                <div class="col-md-8 mb-4">
                    <div class="car-d">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top mb-4" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        
                            <h2 class="card-title"><?php the_title(); ?></h2>
                            <div class="card-text"><?php the_content(); ?></div>
                        
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( 'Previous', 'yourthemename' ),
                'next_text' => __( 'Next', 'yourthemename' ),
            ) );
            ?>
        </nav>

    <?php else : ?>
        <div class="alert alert-info" role="alert">
            <?php _e( 'Sorry, no posts matched your criteria.', 'yourthemename' ); ?>
        </div>
    <?php endif; ?>
    
    
    
<div class="container-wrapper bg-f9f9f9 pb-5">
  <div class="-container">
    <div class="row related-posts">
      
        <?php // Related Posts By Category Starts
          $orig_post = $post;
          global $post;
          $categories = get_the_category($post->ID);
          if ($categories) {
            $category_ids = array();
            foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
            $args=array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page'=> 4, // Number of related posts that will be displayed.
                'caller_get_posts'=>1
            );
            $my_query = new wp_query( $args );
            if( $my_query->have_posts() ) {
              while( $my_query->have_posts() ) {
                $my_query->the_post(); ?>
                <div class="col-sm-6 col-lg-3 mb-5 clesr-fix">
                  <div class="card bg-light">
                    <?php
                        $attachment_id = get_post_thumbnail_id(); 
                        $img_src_small = wp_get_attachment_image_url( $attachment_id, 'mobile-thumbnail' );
                        $img_src_large = wp_get_attachment_image_url( $attachment_id, 'large-thumbnail' );
                    ?>
                    <a class="link_overlay" href="<?php the_permalink();?>" title="<?php echo get_the_title(); ?>"></a>
                    <picture>
                       <source srcset="<?php echo esc_url( $img_src_small ); ?>" media="(max-width: 400px)">
                       <source srcset="<?php echo esc_url( $img_src_large ); ?>">
                       <img class="card-img-top" src="<?php echo esc_url( $img_src_large ); ?>" alt="<?php echo get_the_title(); ?>">
                    </picture>
                    <div class="card-body text-center">
                      <h4 class="card-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4><!-- /caption -->
                      <p class="card-text"><?php echo get_excerpt(500); ?></p>
                      <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">বিস্তারিত&raquo;</a>
                    </div><!-- /card-img-overlay -->
                  </div><!-- /card -->
                </div><!-- /column -->
                <?php }
                }
            }
            $post = $orig_post;
            wp_reset_query();
            // Related Posts By Category Ends
        ?>
      
    </div><!--/row-->
  </div><!--/container-->
</div><!--/ bg-f9f9f9 -->


</main>

<?php get_footer(); ?>