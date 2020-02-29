<?php
/**
 * shopstore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package shopstore
 */

if ( ! function_exists( 'shopstore_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shopstore_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on shopstore, use a find and replace
		 * to change 'shopstore' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shopstore', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'shopstore' ),
			'top_bar_navigation' => esc_html__( 'Top Bar Navigation', 'shopstore' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'shopstore_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		
		/*
		* Enable support for Post Formats.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
			'quote'
		) );
	}
endif;
add_action( 'after_setup_theme', 'shopstore_setup' );

/**
 * Registers an editor stylesheet for the theme.
 */
function shopstore_add_editor_styles() {
    add_editor_style( '//fonts.googleapis.com/css?family=Nunito|Open+Sans|Roboto Condensed' );
}
add_action( 'admin_init', 'shopstore_add_editor_styles' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shopstore_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'shopstore_content_width', 640 );
}
add_action( 'after_setup_theme', 'shopstore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shopstore_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'shopstore' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'shopstore' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'shopstore' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'shopstore' ),
		'before_widget' => '<div id="%1$s" class="col-lg-4 col-md-6"><div class="widget-ft">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Static Home Page', 'shopstore' ),
		'id'            => 'front_page_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'shopstore' ),
		'before_widget' => '<div id="%1$s"  class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title screen-reader-text">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Replace Header Search Bar', 'shopstore' ),
		'id'            => 'replace_header_search',
		'description'   => esc_html__( 'Add widgets here.', 'shopstore' ),
		'before_widget' => '<div id="%1$s"  class="%2$s col-lg-6 col-md-6 col-sm-12">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title screen-reader-text">',
		'after_title'   => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'shopstore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shopstore_scripts() {
	wp_enqueue_style( 'shopstore-google-font','https://fonts.googleapis.com/css?family=Nunito:400,600,700|Open+Sans:400,600,700|Roboto Condensed:400,600,700,900&display=swap' );
	
	/* PLUGIN CSS */
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/css/bootstrap.css' ), array(), '4.0.0' );
	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/vendors/font-awesome/css/fontawesome.css' ), array(), '4.7.0' );
	wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/vendors/owl-carousel/assets/owl-carousel.css' ), array(), '2.3.4' );
	wp_enqueue_style( 'rd-navbar', get_theme_file_uri( '/vendors/rd-navbar/css/rd-navbar.css' ), array(), '2.2.5' );
	wp_enqueue_style( 'tether', get_theme_file_uri( '/vendors/tether/css/tether.css' ), array(), '1.4.4' );
	wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/vendors/magnific-popup/magnific-popup.css' ), array(), '1.1.0' );
	
	
	wp_enqueue_style( 'shopstore-style', get_stylesheet_uri() );
	wp_enqueue_style( 'shopstore-responsive', get_theme_file_uri( '/assets/responsive.css' ), array(), '1.0' );
		
		
				
		$custom_css = '.rd-navbar-static .rd-navbar-nav > li > a:hover,.rd-navbar-static .rd-navbar-dropdown a:hover,.rd-navbar-static .rd-navbar-nav > li:hover,ul.flat-unstyled > li > a:hover,ul.flat-unstyled > li.current-menu-item > a,.box-icon-cart > ul > li > a:hover,.box-icon-cart a:hover,.box-icon-cart .dropdown-box > ul > li .info-product .price,.box-icon-cart .dropdown-box .btn-cart a.view-cart,#secondary .widget li:hover a, a:hover,
#secondary .widget li:hover::before, #secondary .widget li.current-cat::before,a.ui-to-top:hover,article.main-post .content-post ul.meta-post li a:hover,.woocommerce .shopstore-grid-list a.active,.imagebox .box-content .product-name a:hover,.woocommerce ul.products li.product .woocommerce-Price-amount,.compare-wishlist span.bi,.rd-navbar-static .rd-navbar-nav > li:hover > a,.compare-wishlist a:hover,.woocommerce .shopstore-grid-list a:hover,.footer-widgets ul > li > a:hover,#mega-menu > ul.menu > li:hover > a .menu-title,.rd-navbar-static .rd-navbar-nav > li.current-menu-item  > a{color:'.esc_attr( get_theme_mod('primary_color','#37BF91') ).'; }';
		  
		   $custom_css = '.rd-navbar-static .rd-navbar-nav > li > a:focus,.rd-navbar-static .rd-navbar-dropdown a:focus,.rd-navbar-static .rd-navbar-nav > li:focus,ul.flat-unstyled > li > a:focus,ul.flat-unstyled > li.current-menu-item > a,.box-icon-cart > ul > li > a:focus,.box-icon-cart a:focus,.box-icon-cart .dropdown-box > ul > li .info-product .price,.box-icon-cart .dropdown-box .btn-cart a.view-cart,#secondary .widget li:focus a, a:focus,
#secondary .widget li:focus::before, #secondary .widget li.current-cat::before,a.ui-to-top:focus,article.main-post .content-post ul.meta-post li a:focus,.woocommerce .shopstore-grid-list a.active,.imagebox .box-content .product-name a:focus,.woocommerce ul.products li.product .woocommerce-Price-amount,.compare-wishlist span.bi,.rd-navbar-static .rd-navbar-nav > li:focus > a,.compare-wishlist a:focus,.woocommerce .shopstore-grid-list a:focus,.footer-widgets ul > li > a:focus,#mega-menu > ul.menu > li:focus > a .menu-title,.rd-navbar-static .rd-navbar-nav > li.current-menu-item  > a{color:'.esc_attr( get_theme_mod('primary_color','#37BF91') ).'; }';
		  
		  $custom_css .= '.rd-navbar-static .rd-navbar-nav > li > a::after,.box-icon-cart > ul > li > a:hover,.box-icon-cart .icon-cart:hover,.box-icon-cart .dropdown-box .btn-cart a.view-cart,.sidebar .widget .widget-title h3::after,.widget-ft .widget-title h3::after,ul.app-list li:hover,ul.comments-list .comment-reply-link,button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .woocommerce #respond input#submit:hover,.woocommerce-info, .woocommerce-message,.woocommerce .shopstore-grid-list a.active,.product-box:hover .imagebox,.woocommerce .product .woocommerce-tabs ul.tabs li a:hover,.woocommerce .product .woocommerce-tabs ul.tabs li.active a,.woocommerce .shopstore-grid-list a:hover,.related.products h2::after, .upsells.products h2::after, #cross_sell_product h2::after,.rd-navbar-static .rd-navbar-nav > li.current-menu-item > a::after,.tags_wrp a:hover{border-color:'.esc_attr( get_theme_mod('primary_color','#37BF91') ).'; }';
		  
		  $custom_css .= '.box-icon-cart .icon-cart span.count,.box-icon-cart .dropdown-box .btn-cart a.view-cart::before, .box-icon-cart .dropdown-box .btn-cart a.check-out::before,.slide-arrows > button::before, #be-home-slider .owl-nav button::before,
.slide-dots > li > button:hover::before, #be-home-slider .owl-dots button:hover::before, #be-home-slider .owl-dots button.active::before,ul.comments-list .comment-reply-link,button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .woocommerce #respond input#submit:hover,.woocommerce span.onsale,.imagebox .box-bottom .btn-add-cart a::before,.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handl,.woocommerce .actions .button::before, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button::before, .woocommerce div.product form.cart .button::before, .woocommerce .wc-backward::before, .woocommerce-checkout button.button::before, .woocommerce .shipping-calculator-form .button::before, .woocommerce .widget_price_filter .price_slider_amount .button::before,.woocommerce .woocommerce-error .button, .woocommerce .woocommerce-info .button, .woocommerce .woocommerce-message .button, .woocommerce-page .woocommerce-error .button, .woocommerce-page .woocommerce-info .button, .woocommerce-page .woocommerce-message .button, .woocommerce a.button.view,.tags_wrp a:hover,.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.rd-navbar-fixed .rd-navbar-nav li.opened > a, .rd-navbar-fixed .rd-navbar-nav li a:hover{background-color:'.esc_attr( get_theme_mod('primary_color','#37BF91') ).'; }';
	
	
	 $custom_css .= '.rd-navbar-static .rd-navbar-nav > li > a::after,.box-icon-cart > ul > li > a:focus,.box-icon-cart .icon-cart:focus,.box-icon-cart .dropdown-box .btn-cart a.view-cart,.sidebar .widget .widget-title h3::after,.widget-ft .widget-title h3::after,ul.app-list li:focus,ul.comments-list .comment-reply-link,button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, .woocommerce #respond input#submit:focus,.woocommerce-info, .woocommerce-message,.woocommerce .shopstore-grid-list a.active,.product-box:focus .imagebox,.woocommerce .product .woocommerce-tabs ul.tabs li a:focus,.woocommerce .product .woocommerce-tabs ul.tabs li.active a,.woocommerce .shopstore-grid-list a:focus,.related.products h2::after, .upsells.products h2::after, #cross_sell_product h2::after,.rd-navbar-static .rd-navbar-nav > li.current-menu-item > a::after,.tags_wrp a:focus{border-color:'.esc_attr( get_theme_mod('primary_color','#37BF91') ).'; }';
		  
	  $custom_css .= '.box-icon-cart .icon-cart span.count,.box-icon-cart .dropdown-box .btn-cart a.view-cart::before, .box-icon-cart .dropdown-box .btn-cart a.check-out::before,.slide-arrows > button::before, #be-home-slider .owl-nav button::before,
.slide-dots > li > button:focus::before, #be-home-slider .owl-dots button:focus::before, #be-home-slider .owl-dots button.active::before,ul.comments-list .comment-reply-link,button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, .woocommerce #respond input#submit:focus,.woocommerce span.onsale,.imagebox .box-bottom .btn-add-cart a::before,.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handl,.woocommerce .actions .button::before, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button::before, .woocommerce div.product form.cart .button::before, .woocommerce .wc-backward::before, .woocommerce-checkout button.button::before, .woocommerce .shipping-calculator-form .button::before, .woocommerce .widget_price_filter .price_slider_amount .button::before,.woocommerce .woocommerce-error .button, .woocommerce .woocommerce-info .button, .woocommerce .woocommerce-message .button, .woocommerce-page .woocommerce-error .button, .woocommerce-page .woocommerce-info .button, .woocommerce-page .woocommerce-message .button, .woocommerce a.button.view,.tags_wrp a:focus,.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.rd-navbar-fixed .rd-navbar-nav li.opened > a, .rd-navbar-fixed .rd-navbar-nav li a:focus{background-color:'.esc_attr( get_theme_mod('primary_color','#37BF91') ).'; }';
		
	wp_add_inline_style( 'shopstore-style', $custom_css );

	/* PLUGIN JS */
	wp_enqueue_script( 'tether-js', get_theme_file_uri( '/vendors/tether/js/tether.js' ), array(), '1.4.0', true );

	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/js/bootstrap.js' ), 0, '3.3.7', true );
	
	wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/vendors/owl-carousel/owl-carousel.js' ), 0, '2.3.4', true );
	
	wp_enqueue_script( 'rd-navbar-js', get_theme_file_uri( '/vendors/rd-navbar/js/jquery.rd-navbar.js' ), 0, '', true );
	wp_enqueue_script( 'customselect', get_theme_file_uri( '/vendors/customselect.js' ), 0, '', true );
	wp_enqueue_script( 'magnific-popup', get_theme_file_uri( '/vendors/magnific-popup/magnific-popup.js' ), 0, '1.1.0', true );
	//owl-carousel.css
	wp_enqueue_script( 'shopstore-js', get_theme_file_uri( '/assets/shopstore.js'), array('jquery','masonry','imagesloaded'), '1.0.0', true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shopstore_scripts' );

