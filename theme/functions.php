<?php
/**
 * Better Clean functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Better_Clean
 */

if ( ! defined( 'BETTERCLEAN_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'BETTERCLEAN_VERSION', '0.1.8' );
}

if ( ! defined( 'BETTERCLEAN_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `betterclean_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'BETTERCLEAN_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'betterclean_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function betterclean_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Better Clean, use a find and replace
		 * to change 'betterclean' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'betterclean', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'betterclean' ),
				'menu-2' => __( 'Footer 1 Menu', 'betterclean' ),
				'menu-3' => __( 'Footer 2 Menu', 'betterclean' ),
				'menu-4' => __( 'Footer 3 Menu', 'betterclean' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'betterclean_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function betterclean_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'betterclean' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'betterclean' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'betterclean_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function betterclean_scripts() {
	$dep           = [ 'jquery' ];
	wp_enqueue_style( 'betterclean-style', get_stylesheet_uri(), array(), BETTERCLEAN_VERSION );
	wp_enqueue_script( 'betterclean-script', get_template_directory_uri() . '/js/script.min.js', $dep, BETTERCLEAN_VERSION, true );
	wp_enqueue_script( 'fontawesome-script', get_template_directory_uri() . '/js/font-awesome-pro.js', array(), BETTERCLEAN_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'betterclean_scripts' );

/**
 * Enqueue the block editor script.
 */
function betterclean_enqueue_block_editor_script() {
	wp_enqueue_script(
		'betterclean-editor',
		get_template_directory_uri() . '/js/block-editor.min.js',
		array(
			'wp-blocks',
			'wp-edit-post',
		),
		BETTERCLEAN_VERSION,
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'betterclean_enqueue_block_editor_script' );

/**
 * Create a JavaScript array containing the Tailwind Typography classes from
 * BETTERCLEAN_TYPOGRAPHY_CLASSES for use when adding Tailwind Typography support
 * to the block editor.
 */
function betterclean_admin_scripts() {
	?>
	<script>
		tailwindTypographyClasses = '<?php echo esc_attr( BETTERCLEAN_TYPOGRAPHY_CLASSES ); ?>'.split(' ');
	</script>
	<?php
}
add_action( 'admin_print_scripts', 'betterclean_admin_scripts' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function betterclean_tinymce_add_class( $settings ) {
	$settings['body_class'] = BETTERCLEAN_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'betterclean_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * ACF Plugin Check.
 */
if ( ! class_exists( 'acf' ) ) {
	add_action( 'admin_notices', 'acf_custom_admin_notice' );
	return;
}

function acf_custom_admin_notice() { ?>
	<div class="notice notice-error">
		<p><?php echo esc_html__( 'Warning: Advanced Custom Fields is not installed or activated. The ACF plugin is required by this theme!' ); ?></p>
	</div>
	<?php
}

add_filter('acf/settings/save_json', 'acf_custom_json_save_folder');

function acf_custom_json_save_folder( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/acf-json';

    // return
    return $path;

}

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'administrator',
		'position'		=> 31,
		'icon_url'		=> 'dashicons-admin-generic',
		'redirect'		=> false
	));

}

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
		return $data;
	}

	$filetype = wp_check_filetype( $filename, $mimes );

	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];

}, 10, 4 );

function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

/* Disable Gutenberg Block Editor */
add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 * Search Form.
 */
function wp_search_form( $form ) {
	$form = '<section class="search search-form"><form role="search" method="get" action="' . home_url( '/' ) . '" ><label class="screen-reader-text" for="s">' . __('', 'domain') . '</label><input type="text" class="search-field" value="' . get_search_query() . '" name="s" id="s" placeholder="Search..." /><button type="submit" id="searchsubmit"><span><i class="far fa-search"></i></span></button></form></section>';
	return $form;
}

add_filter( 'get_search_form', 'wp_search_form' );


// Reading time calculator
function reading_time($the_post_ID){

	$total_word_count = 0;
	$post_content = get_post_field('post_content', $the_post_ID);
	$total_word_count = str_word_count($post_content);

	$readingtime = ceil($total_word_count / 300);

	if ($readingtime <= 1) { // If the reading time is equal to or less than 1
		$timer = " min";
	} else {
		$timer = " mins";
	}

	if ($readingtime == 0) { // if the reading time equals 0 then change it to 1
		$totalreadingtime = "1" . $timer . " read";
	} else {
		$totalreadingtime = $readingtime . $timer . " read";
	}

	return $totalreadingtime;
}

/**
 * Get Youtube Video ID from url.
 *
 * @param String $url Youtube Link.
 */
function get_youtube_id_from_url( $url ) {
    $regex = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
    preg_match( $regex, $url, $video );
    return $video[7];
}

/**
 * Get Youtube thumbnail image from video ID.
 *
 * @param String $video_id Youtube Video ID.
 */
function get_youtube_thumbnail_from_id( $video_id ) {
    return "https://i3.ytimg.com/vi/$video_id/hqdefault.jpg"; // pass 0,1,2,3 for different sizes like 0.jpg, 1.jpg.
}

/**
 * Get Vimeo ID from video link.
 *
 * @param String $url Vimeo video link.
 */
function get_vimeo_id_from_url( $url ) {
    if ( preg_match( '#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*#', $url, $m ) ) {
        return $m[1];
    }
    return false;
}

/**
 * Get Vimeo thumbnail image from video ID.
 *
 * @param String $id Vimeo video ID.
 */
function get_vimeo_thumbnail_from_id( $id ) {
    $arr_vimeo       = file_get_contents( "https://vimeo.com/api/v2/video/$id.php" );
    $arr_vimeo_array = unserialize( $arr_vimeo );
    $thumb_url       = $arr_vimeo_array[0]['thumbnail_large'];
    $thubm_url       = str_replace( 'http:', 'https:', $thumb_url );
    return $thubm_url;
}

function custom_breadcrumb() {
    // Get the current post or page information
    global $post;

    // Define the home text and URL
    $home_text = 'Home';
    $home_url = get_home_url();

    // Initialize the breadcrumb HTML
    $breadcrumb = '<div class="breadcrumb">';

    // Add the home link to the breadcrumb
    $breadcrumb .= '<a href="' . $home_url . '">' . $home_text . '</a>';

    // Separator
    $separator = '<div class="separator"></div>';

    if (is_home()) {
        $breadcrumb .= $separator;
        $breadcrumb .= '<span class="current">Blog</span>';
    } elseif (is_singular('services')) {
        // Custom post type: services
		$services_page = get_page_by_path('services');
        $breadcrumb .= $separator;
        $breadcrumb .= '<a href="' . get_permalink($services_page->ID) . '">Services</a>';
        $breadcrumb .= $separator;
        $breadcrumb .= '<span class="current">' . get_the_title($post) . '</span>';
    } elseif (is_singular()) {
		// $services_page = get_page_by_path('blog');
        // $breadcrumb .= $separator;
        // $breadcrumb .= '<a href="' . get_permalink($services_page->ID) . '">Blog</a>';
        $breadcrumb .= $separator;
        $breadcrumb .= '<a href="' . get_permalink($post) . '">' . get_the_title($post) . '</a>';
    } elseif (is_category()) {
        $category = get_queried_object();
        $breadcrumb .= $separator;
        $breadcrumb .= '<span class="current">' . $category->name . '</span>';
    } elseif (is_post_type_archive()) {
        $post_type = get_post_type_object(get_post_type());
        $breadcrumb .= $separator;
        $breadcrumb .= '<span class="current">' . $post_type->labels->name . '</span>';
    } elseif (is_search()) {
        $breadcrumb .= $separator;
        $breadcrumb .= '<span class="current">Search</span>';
    }

    // Add more conditions for other archive pages or custom taxonomies if needed

    $breadcrumb .= '</div>';

    echo $breadcrumb;
}


function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyC-tMTaMZqa4hthLji_rcPqL3Sw28frfh8';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


class Better_Sidebar_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'better_sidebar_widget', // Widget ID
            'Better Sidebar Widget', // Widget name
            array('description' => 'A custom widget with search, categories, and posts for the better sidebar')
        );
    }

    public function widget($args, $instance) {
        // Widget frontend display
        echo $args['before_widget'];

        echo get_search_form();

        echo '<h2 class="bwc-heading">Categories</h2>';					
		$categories = get_categories();
		if ($categories) {
			echo '<ul>';
			$count = 0;
			foreach ($categories as $category) {
				if ($count >= 3) {
					break; 
				}
				echo '<li class="bwc-list"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
				$count++;
			}
			echo '</ul>';
		};

        echo '<h2 class="bwc-heading">Recent Posts</h2>';
        $recent_posts = new WP_Query(array('posts_per_page' => 3));
        if ($recent_posts->have_posts()) {
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
				if ( has_post_thumbnail($recent_posts->ID)) :
					$thumbnail = get_the_post_thumbnail($recent_posts->ID, 'medium');
				endif;
				echo'<div class="post-card"><a class="post-link" href="'.get_the_permalink() .'" target="_self" role="link" aria-label="'. get_the_title().'"><figure class="featured-image">'.$thumbnail.'</figure></a><div class="post-body"><div class="post-date">'.get_the_date('F d, Y').'</div><div class="post-title">'.get_the_title().'</div><a class="post-readmore" href="'.get_the_permalink().'" target="_self" role="link" aria-label="Read article">Read article <span><i class="far fa-arrow-right"></i></span></a></div></div>';
            }
           
        }
        wp_reset_postdata();

        echo $args['after_widget'];
    }

    public function form($instance) {
        // Widget backend form
        // You can add settings fields here if needed
    }

    public function update($new_instance, $old_instance) {
        // Update widget settings
    }
}
// Register the widget
function register_better_sidebar_widget() {
    register_widget('Better_Sidebar_Widget');
}

add_action('widgets_init', 'register_better_sidebar_widget');

function custom_login_shortcode_fn() {
    ob_start();

    if (!is_user_logged_in()) { // Display WordPress login form:
        $args = array(
            'redirect' => admin_url(),
            'form_id' => 'loginform-custom',
            'label_username' => __(''),
            'label_password' => __(''),
            'label_remember' => __(''),
            'label_log_in' => __('Sign In'),
            'remember' => false,
        );

        return wp_login_form($args);

        ob_clean(); // Clean the output buffer
    } else { // If logged in:
        ob_end_clean(); // Clean and end the output buffer
        $logout_url = wp_logout_url(home_url()); // Get the logout URL
        $admin_url = admin_url(); // Get the admin URL
        
        return "<a href='$logout_url'>" . __('Log Out') . "</a> | <a href='$admin_url'>" . __('Site Admin') . "</a>";
    }
}

add_shortcode('custom_log_in', 'custom_login_shortcode_fn');

function redirect_logged_in_users() {
    if (is_user_logged_in() && is_page('login')) {
        wp_redirect(home_url());
        exit();
    }
}
add_action('template_redirect', 'redirect_logged_in_users');