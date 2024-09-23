<!-- 
 file location to edit: shared/aside/recent_posts.php 
-->

<?php // RECENT POST STARTS
    $recentPosts = new WP_Query('posts_per_page=10');
    if ($recentPosts->have_posts()) : ?>
        <div class="sidebar-module sidebar-module-inset animate py-4">
            <div class="list-group-wraper">
                <div class="list-group">
                    <h4 class="list-group-item list-group-item-action widget-title m-0 py-3">সাম্প্রতিক আর্টিকেল</h4>
                    <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
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
                    <?php endwhile; ?>
                </div>
            </div>
        </div><!--/sidebar-module -->
    <?php else:
        echo '<h4>শীঘ্রইি আসছে আরো নতুন আর্টিকেল</h4>';
    endif;
    wp_reset_postdata();
    // RECENT POST ENDS HERE
?>

