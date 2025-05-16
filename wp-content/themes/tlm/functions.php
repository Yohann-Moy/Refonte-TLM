<?php
/**
 * Tracy-le-Mont functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tracy-le-Mont
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tlm_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Tracy-le-Mont, use a find and replace
		* to change 'tlm' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'tlm', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'tlm' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'tlm_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'tlm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tlm_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tlm_content_width', 640 );
}
add_action( 'after_setup_theme', 'tlm_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tlm_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tlm' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tlm' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tlm_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tlm_scripts() {
	/*wp_enqueue_style( 'tlm-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'tlm-style', 'rtl', 'replace' );

	wp_enqueue_script( 'tlm-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}*/
	$template = basename( get_page_template_slug());
	$template = str_replace( '.php', '', $template );

	wp_enqueue_style( $template.'-styles', get_template_directory_uri() . '/assets/css/build/pages/'.$template.'.css', array(), _S_VERSION );
		echo $template;

}
add_action( 'wp_enqueue_scripts', 'tlm_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
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

  // ******************** Crunchify Tips - Clean up WordPress Header START ********************** //

function crunchify_remove_version() {
	return '';
	}
	add_filter('the_generator', 'crunchify_remove_version');
	 
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
	remove_action('template_redirect', 'rest_output_link_header', 11, 0);
	 
	remove_action ('wp_head', 'rsd_link');
	remove_action( 'wp_head', 'wlwmanifest_link');
	remove_action( 'wp_head', 'wp_shortlink_wp_head');
	 
	function crunchify_cleanup_query_string( $src ){ 
	$parts = explode( '?', $src ); 
	return $parts[0]; 
	} 
	add_filter( 'script_loader_src', 'crunchify_cleanup_query_string', 15, 1 ); 
	add_filter( 'style_loader_src', 'crunchify_cleanup_query_string', 15, 1 );
	
	// REMOVE WP EMOJI
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	
	// REMOVE global-styles-inline-css //
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	
	function webapptiv_remove_block_library_css()
	{
	wp_dequeue_style( 'wp-block-library' );
	}
	add_action( 'wp_enqueue_scripts', 'webapptiv_remove_block_library_css' );
	
	
		// remove all tags from header
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head',      'rest_output_link_wp_head'              );
		remove_action( 'wp_head',      'wp_oembed_add_discovery_links'         );
		remove_action( 'template_redirect', 'rest_output_link_header', 11 );
	
	// ******************** Clean up WordPress Header END ********************** //
	























/**
 * Fonctions personnelles
 * 
 * @package TLM
 * @author Karl Clémence
 * @param string $field - Le champ à vérifier (au format chaine de caractères)
 * @param string $name - Nature du champ permettant de personnaliser le message par défaut (au format chaine de caractères)
 * @return string - La valeur du champ ou la valeur par défaut
 * 
 * 
**/
	function verifyTextField(string $field, string $name = 'Valeur'): string{
		//syntaxe ternaire qui permet de condenser les conditions
		// Après le ? c'est ce qui est exécuté si la condiiton est vraie
		// Après le : c'est ce qui est exécuté si la condition est fausse

		return !empty(trim($field)) ? $field : $name.' par défaut';
	}

	//Custom Post Type/

	function cw_post_type_events() {
		$supports = array(
		'title', // post title
		//'editor', // post content
		'thumbnail', // featured images
		'post-formats', // post formats
		);
		$labels = array(
		'name' => _x('Evènements', 'plural'),
		'singular_name' => _x('évènement', 'singular'),
		'menu_name' => _x('Evènements', 'admin menu'),
		'name_admin_bar' => _x('Evènements', 'admin bar'),
		'add_new' => _x('Ajouter', 'add new'),
		'add_new_item' => ('Ajouter un évènement'),
		'new_item' => ('Nouvel évènement'),
		'edit_item' => ("Mettre à jour l'évènement"),
		'view_item' => ("Voir l'évènement"),
		'all_items' => ('Tous les évènements'),
		'search_items' => ('Rechercher un évènement'),
		'not_found' => __('Aucun évènement trouvé'),
		);
		$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'query_var' => false,
		'rewrite' => array(
			'slug' => 'évènement', // Conserver le terme 'histoire' au singulier pour conserver la pagination
			'with_front' => false, // Retire /blog devant l'URL
		),
		// 'taxonomies'  => array( 'category' ),
		'has_archive' => false,
		'hierarchical' => false,
		'show_ui'            => true,  // Affiche l'interface d'administration
		'show_in_menu'       => true,  // Montre dans le menu d'administration
		);
		register_post_type('évènements', $args);
	}
	add_action('init', 'cw_post_type_events');
