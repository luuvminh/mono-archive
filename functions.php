<?php
/**
 * Mono Archive Theme Functions
 *
 * @package Mono_Archive
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'MONO_ARCHIVE_VERSION', '1.0.0' );
define( 'MONO_ARCHIVE_DIR', get_template_directory() );
define( 'MONO_ARCHIVE_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function mono_archive_setup() {
    // Add theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );

    // Custom image sizes for the editorial grid
    add_image_size( 'mono-hero', 1600, 900, true );        // 16:9
    add_image_size( 'mono-portrait', 800, 1000, true );     // 4:5
    add_image_size( 'mono-square', 800, 800, true );        // 1:1
    add_image_size( 'mono-tall', 600, 800, true );          // 3:4
    add_image_size( 'mono-ultrawide', 1600, 686, true );    // 21:9
    add_image_size( 'mono-archive-thumb', 384, 256, true ); // Archive thumbnails
    add_image_size( 'mono-related', 600, 600, true );       // Related posts

    // Register nav menus
    register_nav_menus( array(
        'primary'  => esc_html__( 'Primary Navigation', 'mono-archive' ),
        'footer'   => esc_html__( 'Footer Navigation', 'mono-archive' ),
    ) );

    // Set content width
    if ( ! isset( $content_width ) ) {
        $content_width = 1440;
    }
}
add_action( 'after_setup_theme', 'mono_archive_setup' );

/**
 * Enqueue Scripts and Styles
 */
function mono_archive_scripts() {
    // Google Fonts - Inter
    wp_enqueue_style(
        'mono-archive-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap',
        array(),
        null
    );

    // Material Symbols
    wp_enqueue_style(
        'mono-archive-icons',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'mono-archive-style',
        get_stylesheet_uri(),
        array( 'mono-archive-fonts', 'mono-archive-icons' ),
        MONO_ARCHIVE_VERSION
    );

    // Theme JavaScript
    wp_enqueue_script(
        'mono-archive-main',
        MONO_ARCHIVE_URI . '/assets/js/main.js',
        array(),
        MONO_ARCHIVE_VERSION,
        true
    );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'mono_archive_scripts' );

/**
 * Register Custom Meta Fields for Photo Metadata
 */
function mono_archive_register_meta() {
    $meta_fields = array(
        'capture_date' => 'string',
        'equipment'    => 'string',
        'settings'     => 'string',
        'location'     => 'string',
        'series'       => 'string',
        'plate_number' => 'string',
        'exposure_ev'  => 'string',
        'image_type'   => 'string', // 'color' or 'bw'
    );

    foreach ( $meta_fields as $key => $type ) {
        register_post_meta( 'post', '_mono_' . $key, array(
            'show_in_rest'  => true,
            'single'        => true,
            'type'          => $type,
            'auth_callback' => function() {
                return current_user_can( 'edit_posts' );
            },
        ) );
    }
}
add_action( 'init', 'mono_archive_register_meta' );

/**
 * Add Meta Boxes for Photo Details
 */
function mono_archive_add_meta_boxes() {
    add_meta_box(
        'mono_photo_details',
        __( 'Photo Details', 'mono-archive' ),
        'mono_archive_photo_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'mono_archive_add_meta_boxes' );

/**
 * Render Photo Details Meta Box
 */
function mono_archive_photo_meta_box( $post ) {
    wp_nonce_field( 'mono_archive_photo_meta', 'mono_archive_photo_nonce' );

    $fields = array(
        'capture_date' => __( 'Capture Date', 'mono-archive' ),
        'equipment'    => __( 'Equipment', 'mono-archive' ),
        'settings'     => __( 'Camera Settings', 'mono-archive' ),
        'location'     => __( 'Location', 'mono-archive' ),
        'series'       => __( 'Series', 'mono-archive' ),
        'plate_number' => __( 'Plate Number', 'mono-archive' ),
        'exposure_ev'  => __( 'Exposure EV', 'mono-archive' ),
    );

    echo '<table class="form-table"><tbody>';

    foreach ( $fields as $key => $label ) {
        $value = get_post_meta( $post->ID, '_mono_' . $key, true );
        printf(
            '<tr><th><label for="mono_%1$s">%2$s</label></th><td><input type="text" id="mono_%1$s" name="mono_%1$s" value="%3$s" class="regular-text" /></td></tr>',
            esc_attr( $key ),
            esc_html( $label ),
            esc_attr( $value )
        );
    }

    // Image type select
    $image_type = get_post_meta( $post->ID, '_mono_image_type', true );
    echo '<tr><th><label for="mono_image_type">' . esc_html__( 'Image Type', 'mono-archive' ) . '</label></th>';
    echo '<td><select id="mono_image_type" name="mono_image_type">';
    echo '<option value="bw"' . selected( $image_type, 'bw', false ) . '>' . esc_html__( 'Black & White', 'mono-archive' ) . '</option>';
    echo '<option value="color"' . selected( $image_type, 'color', false ) . '>' . esc_html__( 'Color', 'mono-archive' ) . '</option>';
    echo '</select></td></tr>';

    echo '</tbody></table>';
}

/**
 * Save Photo Details Meta
 */
function mono_archive_save_photo_meta( $post_id ) {
    if ( ! isset( $_POST['mono_archive_photo_nonce'] ) ||
         ! wp_verify_nonce( $_POST['mono_archive_photo_nonce'], 'mono_archive_photo_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array( 'capture_date', 'equipment', 'settings', 'location', 'series', 'plate_number', 'exposure_ev', 'image_type' );

    foreach ( $fields as $key ) {
        if ( isset( $_POST[ 'mono_' . $key ] ) ) {
            update_post_meta( $post_id, '_mono_' . $key, sanitize_text_field( $_POST[ 'mono_' . $key ] ) );
        }
    }
}
add_action( 'save_post', 'mono_archive_save_photo_meta' );

/**
 * Custom Walker for Primary Navigation
 */
class Mono_Archive_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $is_current = in_array( 'current-menu-item', $classes ) || in_array( 'current_page_item', $classes );

        $base_classes = "font-inter tracking-tight font-bold uppercase text-sm transition-colors duration-300";
        $active_classes = $is_current ? "text-black border-b-2 border-black pb-1" : "text-neutral-500 hover:text-black";

        $output .= sprintf(
            '<a href="%s" class="%s %s">%s</a>',
            esc_url( $item->url ),
            esc_attr( $base_classes ),
            esc_attr( $active_classes ),
            esc_html( $item->title )
        );
    }

    function start_lvl( &$output, $depth = 0, $args = null ) {}
    function end_lvl( &$output, $depth = 0, $args = null ) {}
    function end_el( &$output, $item, $depth = 0, $args = null ) {}
}

/**
 * Helper: Get image type tag HTML
 */
function mono_archive_image_tag( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $image_type = get_post_meta( $post_id, '_mono_image_type', true );

    if ( $image_type === 'color' ) {
        return '<div class="mono-tag mono-tag--color">
            <span class="mono-tag__dot"></span>
            <span class="mono-tag__label">Color</span>
        </div>';
    }

    return '<div class="mono-tag mono-tag--bw">
        <span class="mono-tag__label">B&W</span>
    </div>';
}

/**
 * Helper: Get photo metadata
 */
function mono_archive_get_meta( $key, $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    return get_post_meta( $post_id, '_mono_' . $key, true );
}

/**
 * Register Widget Areas
 */
function mono_archive_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Newsletter Section', 'mono-archive' ),
        'id'            => 'newsletter',
        'description'   => esc_html__( 'Widget area for email subscription.', 'mono-archive' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title mono-display-md">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'mono_archive_widgets_init' );

/**
 * Customize excerpt length
 */
function mono_archive_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'mono_archive_excerpt_length' );

/**
 * Customize excerpt more
 */
function mono_archive_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'mono_archive_excerpt_more' );

/**
 * Add custom body classes
 */
function mono_archive_body_classes( $classes ) {
    $classes[] = 'mono-archive';

    if ( is_singular() ) {
        $classes[] = 'mono-singular';
    }

    if ( is_front_page() ) {
        $classes[] = 'mono-home';
    }

    return $classes;
}
add_filter( 'body_class', 'mono_archive_body_classes' );
