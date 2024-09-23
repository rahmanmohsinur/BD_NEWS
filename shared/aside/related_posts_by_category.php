<!-- 
 file location to edit: shared/aside/related_posts_by_category.php 
-->

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
            'posts_per_page'=> 5, // Number of related posts that will be displayed.
            'caller_get_posts'=>5
        );
        $my_query = new wp_query( $args );
        if( $my_query->have_posts() ) { ?>
            <div class="sidebar-module sidebar-module-inset animate py-4">
                <div class="">
                    <div class="list-group">
                    <h4 class="list-group-item list-group-item-action widget-title m-0 py-3">একই সম্পর্কিত আরো আর্টিকেল</h4>
                    <?php while( $my_query->have_posts() ) {
                        $my_query->the_post(); ?>
                        <div class="list-group-item list-group-item-action">
                            <div class="media">
                            <a href="<?php the_permalink();?>" title="<?php echo wp_trim_words( get_the_title(), 10, '' ); ?>">
                                <?php 
                                if ( has_post_thumbnail() ) { ?>
                                    <img src="<?php the_post_thumbnail_url('xs-sq-thumbnail'); ?>" class="align-self-start mr-3" />
                                <?php } ?>
                            </a>
                            <div class="media-body">
                                <span><?php echo BD_NEWS_article_published_time(); ?></span>
                                <h5><a href="<?php the_permalink();?>" title="<?php echo wp_trim_words( get_the_title(), 10, '' ); ?>"><?php echo wp_trim_words( get_the_title(), 10, '' ); ?></a></h5>
                            </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div><!--/sidebar-module -->

        <?php 
        }
    }
    $post = $orig_post;
    wp_reset_query();
    // Related Posts By Category Ends
?>




