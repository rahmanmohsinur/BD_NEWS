<?php
/**
 * Theme setup.
 */
function BD_NEWS_setup() {
    // Add theme support for title tag
    add_theme_support( 'title-tag' );

    // Add theme support for post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Register primary navigation menu
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'BD_NEWS' ),
        'footer'  => __( 'Footer Menu', 'BD_NEWS' ),
    ) );

    // Add theme support for HTML5 markup
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Add theme support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}
add_action( 'after_setup_theme', 'BD_NEWS_setup' );

/**
 * Enqueue scripts and styles.
 */
function BD_NEWS_enqueue_scripts() {
    // Enqueue Bootstrap CSS
    wp_enqueue_style( 'bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' );

    // Enqueue theme stylesheet
    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );

    // Enqueue Bootstrap JS
    wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array( 'jquery' ), null, true );

    // Enqueue theme script
    wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'BD_NEWS_enqueue_scripts' );

/**
 * Register widget areas.
 */
function BD_NEWS_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'BD_NEWS' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here.', 'BD_NEWS' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'BD_NEWS_widgets_init' );

/**
 * Custom excerpt length.
 */
function BD_NEWS_excerpt_length( $length ) {
    return 30; // Change the number to set the number of words in the excerpt
}
add_filter( 'excerpt_length', 'BD_NEWS_excerpt_length' );

/**
 * Custom excerpt more text.
 */
function BD_NEWS_excerpt_more( $more ) {
    return '... <a class="read-more" href="' . get_permalink() . '">' . __( 'Read More', 'yourthemename' ) . '</a>';
}
add_filter( 'excerpt_more', 'BD_NEWS_excerpt_more' );


// Excerpt Count LETTER Length Cuttomaization
function get_excerpt($limit){
    $excerpt = get_the_content();
    $excerpt = preg_replace(" ([.*?])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    return $excerpt;
}




/*
* An extended class to modify navbar menu adjusted with bootstrap classes and wp category
*/

class Bootstrap_Walker_Category extends Walker_Category {
    // Start Level
    function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( $depth > 0 ) {
            return;
        }
        $indent = str_repeat( "\t", $depth );
        $classes = array( 'dropdown-menu' );
        $class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $output .= "\n$indent<ul$class_names>\n";
    }

    // Start Element
    function start_el( &$output, $category, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $depth ? array() : array( 'nav-item' );
        $class_names[] = 'menu-item-' . $category->term_id;
        if ( !empty($args['has_children']) ) {
            $class_names[] = 'dropdown';
        }
        $class_names[] = 'nav-item';
        $class_names[] = 'nav-link';
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', $class_names, $category, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $output .= $indent . '<li' . $class_names .'>';

        $atts = array();
        $atts['href'] = get_category_link( $category->term_id );
        $atts['class'] = 'nav-link';
        if ( !empty($args['has_children']) ) {
            $atts['class'] .= ' dropdown-toggle';
            $atts['data-toggle'] = 'dropdown';
            $atts['id'] = 'navbardrop';
        }
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( !empty($value) ) {
                $value = esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $title = apply_filters( 'the_category', $category->name, $category );

        $item_output = $args['before'];
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args['link_before'] . $title . $args['link_after'];
        $item_output .= '</a>';
        $item_output .= $args['after'];

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $category, $depth, $args, $id );
    }
}

/*
* Add the necessary JavaScript for handling the AJAX request
*/

function enqueue_infinite_scroll_script() {
    if ( is_single() ) {
        wp_enqueue_script( 'infinite-scroll', get_template_directory_uri() . '/assets/js/infinite-scroll.js', array( 'jquery' ), '1.0', true );

        // Pass necessary data to JavaScript
        wp_localize_script( 'infinite-scroll', 'infiniteScroll', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'post_id'  => get_the_ID(), // Current post ID
            'cat_id'   => get_the_category()[0]->term_id, // First category ID of the current post
        ));
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_infinite_scroll_script' );

// Handle the AJAX request and fetch the next set of posts
function load_more_posts() {
    $post_id = intval( $_POST['post_id'] );
    $cat_id = intval( $_POST['cat_id'] );
    $offset = intval( $_POST['offset'] );

    $args = array(
        'cat' => $cat_id, // Posts from the same category
        'post__not_in' => array( $post_id ), // Exclude current post
        'posts_per_page' => 1, // Load one post at a time
        'offset' => $offset,
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part( 'template-parts/single/content', 'single' ); // Use a template part to format the post
        }
    }

    wp_die(); // Required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_load_more_posts', 'load_more_posts' );
add_action( 'wp_ajax_nopriv_load_more_posts', 'load_more_posts' );



?>
