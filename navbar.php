<header id="header" class="">
    <div class="container" style="padding: 0 0;">
        <div class="r-o-w">
            <nav class="navbar navbar-expand-xl navbar-light bg-light">

                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                    bloginfo( 'name' );
                    // Display the site title or logo
                    if ( function_exists( 'the_custom_logo' ) ) {
                        the_custom_logo();
                    } else {
                        // bloginfo( 'name' );
                        echo get_bloginfo('name', 'display');
                    }
                    ?>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div  style="overflow-x: clip; width: 100%;">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        
                        <ul class="navbar-nav mr-auto">
                            <?php
                            // Display categories with Bootstrap classes
                            $args = array(
                                'title_li'          => '', // Remove default title list item
                                'walker'            => new Bootstrap_Walker_Category(), // Use custom walker class
                                'show_option_all'   => '', // Show all option
                                'show_count'        => 0, // Show post count
                                'hide_empty'        => 1, // Hide empty categories
                                'echo'              => 1, // Output directly
                                'depth'             => 3, // Adjust depth as needed
                                'current_category'  => 0, // Current category
                                'has_children'      => true // Show categories with children
                            );
                            wp_list_categories( $args );
                            ?>
                        </ul>
    
                        <form class="form-inline my-2 my-lg-0" method="get" action="<?php echo home_url('/'); ?>">
                            <div class="input-group">
                                <input type="search" name="s" class="form-control border border-secondary" placeholder="Search" aria-label="Search" value="<?php echo get_search_query(); ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary input-group-text-" type="submit">
                                        <i class="fas fa-search"></i> <!-- FontAwesome Search Icon -->
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </nav>
        </div>
    </div>
</header>
