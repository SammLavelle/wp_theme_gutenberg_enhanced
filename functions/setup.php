<?php
/* ----- Set up ----- */
function custom_setup()
{

    load_theme_textdomain('custom', get_template_directory() . '/languages'); // Localisation Support

    add_theme_support('title-tag'); //allows Yoast to manage title tags

    //add_theme_support( 'automatic-feed-links' ); // Enables post and comment RSS feed links to head

    add_theme_support( 'custom-logo' );

    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script')); //This feature allows the use of HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption.

    // Gutenberg theme support
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    //cleanup header
    remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_generator'); // remove wordpress version
    remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
    remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
    remove_action('wp_head', 'index_rel_link'); // remove link to index page
    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
    remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Remove shortlink (google ignores it so it's pointless)
}
add_action('after_setup_theme', 'custom_setup');

add_filter('xmlrpc_enabled', '__return_false'); //Disable xmlrpc.php (for security)


/* ----- Disable Emoji mess ----- */
function disable_wp_emojicons()
{
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'disable_wp_emojicons');

/* ----- Remove comments ----- */
// Removes from admin menu
function my_remove_admin_menus()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'my_remove_admin_menus');

// Removes from post and pages
function remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
add_action('init', 'remove_comment_support', 100);

// Removes from admin bar
function mytheme_admin_bar_render()
{
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');

/* ----- Enqueue stylesheet  & js ----- */
function enqueue_scripts_styles()
{
    wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/style.min.css');
    wp_enqueue_script('functions-js', get_template_directory_uri() . '/assets/js/functions.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts_styles');

function load_dashicons_front_end()
{
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'load_dashicons_front_end');

/* ----- Add reusable blocks to dash ----- */
function be_reusable_blocks_admin_menu()
{
    add_menu_page('Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
}
add_action('admin_menu', 'be_reusable_blocks_admin_menu');

/* ----- Add MIME type for SVG uploads. ----- */
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/* -----  Create menus ----- */
function register_my_menu()
{
    register_nav_menu('main-menu', __('Main Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'register_my_menu');


/* -----  Create widget area (Sidebar) ----- */
function wpdocs_theme_slug_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'post-sidebar', 'textdomain' ),
        'id'            => 'post-sidebar',
        'description'   => __( 'Widgets in this area will be shown on all posts.', 'textdomain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );

/* ----- Gutenberg ----- */
// Add custom editor font sizes
add_theme_support(
    'editor-font-sizes',
    array(
        array(
            'name'      => esc_html__('Small', 'custom'),
            'shortName' => esc_html_x('S', 'Font size', 'custom'),
            'size'      => 13,
            'slug'      => 's',
        ),
        array(
            'name'      => esc_html__('Normal', 'custom'),
            'shortName' => esc_html_x('N', 'Font size', 'custom'),
            'size'      => 16,
            'slug'      => 'default',
        ),
        array(
            'name'      => esc_html__('Medium', 'custom'),
            'shortName' => esc_html_x('M', 'Font size', 'custom'),
            'size'      => 20,
            'slug'      => 'm',
        ),
        array(
            'name'      => esc_html__('Large', 'custom'),
            'shortName' => esc_html_x('L', 'Font size', 'custom'),
            'size'      => 24,
            'slug'      => 'l',
        ),
        array(
            'name'      => esc_html__('Extra Large', 'custom'),
            'shortName' => esc_html_x('XL', 'Font size', 'custom'),
            'size'      => 28,
            'slug'      => 'xl',
        ),
        array(
            'name'      => esc_html__('XXL', 'custom'),
            'shortName' => esc_html_x('XXL', 'Font size', 'custom'),
            'size'      => 34,
            'slug'      => 'xxl',
        ),
        array(
            'name'      => esc_html__('XXXL', 'custom'),
            'shortName' => esc_html_x('XXXL', 'Font size', 'custom'),
            'size'      => 40,
            'slug'      => 'xxxl',
        ),
        array(
            'name'      => esc_html__('XXXXL', 'custom'),
            'shortName' => esc_html_x('XXXXL', 'Font size', 'custom'),
            'size'      => 58,
            'slug'      => 'xxxxl',
        )
    )
);



/* ----- Pagination ----- */
function custom_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'next_text' => '→',
        'prev_text' => '←',
        'mid_size'  => 5,
    ));
}

/* ----- Excerpts ----- */
// create get_excerpt function allowing you to customise excerpt length
function get_excerpt($limit, $source = null)
{

    if ($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    $excerpt = $excerpt . '...';
    return $excerpt;
}

// Changing excerpt 'more' (amends gutenberg's 'latest post' excerpt output)
function new_excerpt_more($more)
{
    global $post;
    return '…';
}
add_filter('excerpt_more', 'new_excerpt_more');



/* Customiser modifications */
function customize_additional_settings($wp_customize) {
  /* Add settings for the site colours */
  $wp_customize->add_setting('custom_primary_color', array(
    'default' => '#009ca6',
  ));
  $wp_customize->add_setting('custom_secondary_color', array(
    'default' => '#003e42',
  ));
  $wp_customize->add_setting('custom_tertiary_color', array(
    'default' => '#003e42',
  ));
  $wp_customize->add_setting('custom_text_color', array(
    'default' => '#474747',
  ));
  $wp_customize->add_setting('custom_light_grey', array(
    'default' => '#f3f3f6',
  ));
  $wp_customize->add_setting('custom_dark_grey', array(
    'default' => '#474747',
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'custom_primary_color', array(
      'label' => 'Primary Color',
      'section' => 'title_tagline',
      'settings' => 'custom_primary_color',

  )));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'custom_secondary_color', array(
      'label' => 'Secondary Color',
      'section' => 'title_tagline',
      'settings' => 'custom_secondary_color',
  )));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'custom_tertiary_color', array(
    'label' => 'Tertiary Color',
    'section' => 'title_tagline',
    'settings' => 'custom_tertiary_color',
)));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'custom_text_color', array(
    'label' => 'Text Color',
    'section' => 'title_tagline',
    'settings' => 'custom_text_color',
)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'custom_light_grey', array(
        'label' => 'Light Grey',
        'section' => 'title_tagline',
        'settings' => 'custom_light_grey',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'custom_dark_grey', array(
        'label' => 'Dark Grey',
        'section' => 'title_tagline',
        'settings' => 'custom_dark_grey',
    )));
}

add_action('customize_register', 'customize_additional_settings');

/* Create a custom colour object */
$colours = (object) [
    "primary" => get_theme_mod('custom_primary_color', '#009ca6'),
    "secondary" => get_theme_mod('custom_secondary_color', '#003e42'),
    "tertiary" => get_theme_mod('custom_tertiary_color', '#003e42'),
    "text" => get_theme_mod('custom_text_color', '#474747'),
    "white" => "#ffffff",
    "lgrey" => get_theme_mod('custom_light_grey', '#f3f3f6'),
    "dgrey" => get_theme_mod('custom_dark_grey', '#474747'),
    "black" => "#000000"
    
];

add_action('wp_head', function ($args) use ($colours) {my_custom_styles($colours);}, 1);

/* add css file with colours to the head */
function my_custom_styles($colours)
{
  echo "
  <style>
    :root{
      --color-primary:" . $colours->primary . ";
      --color-secondary:" . $colours->secondary . ";
      --color-tertiary:" . $colours->tertiary . ";
      --color-text:" . $colours->text . ";
      --color-white:" . $colours->white . ";
      --color-lgrey:" . $colours->lgrey . ";
      --color-dgrey:" . $colours->dgrey . ";
      --color-black:" . $colours->black . ";
    }
  </style>
 ";
}

/* Add custom colours to gutenberg editor */
add_theme_support('editor-color-palette', array(
    array(
        'name' => esc_html__('Primary', 'custom'),
        'slug' => 'primary',
        'color' => $colours->primary,
    ),
    array(
        'name' => esc_html__('Secondary', 'custom'),
        'slug' => 'secondary',
        'color' => $colours->secondary,
    ),
    array(
        'name' => esc_html__('Tertiary', 'custom'),
        'slug' => 'tertiary',
        'color' => $colours->tertiary,
    ),
    array(
        'name'  => esc_html__('White', 'custom'),
        'slug'  => 'white',
        'color' => $colours->white,
    ),
    array(
        'name'  => esc_html__('Light Grey', 'custom'),
        'slug'  => 'lgrey',
        'color' => $colours->lgrey,
    ),
    array(
        'name'  => esc_html__('Dark grey', 'custom'),
        'slug'  => 'dgrey',
        'color' => $colours->dgrey,
    ),
    array(
        'name'  => esc_html__('Black', 'custom'),
        'slug'  => 'black',
        'color' => $colours->black,
    ),

  )
);


//Get the colors formatted for use with gutenberg editor palette
function output_the_colors()
{

    // get the colors
    $color_palette = current((array) get_theme_support('editor-color-palette'));

    // bail if there aren't any colors found
    if (!$color_palette) {
        return;
    }

    // output begins
    ob_start();

    // output the names in a string
    echo '[';
    foreach ($color_palette as $color) {
        echo "'" . $color['color'] . "', ";
    }
    echo ']';

    return ob_get_clean();

}

//Add the colors into ACF
function gutenberg_sections_register_acf_color_palette()
{

    $color_palette = output_the_colors();
    if (!$color_palette) {
        return;
    }

    ?>
    <script type="text/javascript">
        (function( $ ) {
            acf.add_filter( 'color_picker_args', function( args, $field ){

                // add the hexadecimal codes here for the colors you want to appear as swatches
                args.palettes = <?php echo $color_palette; ?>

                // return colors
                return args;

            });
        })(jQuery);
    </script>
    <?php
}
add_action('acf/input/admin_footer', 'gutenberg_sections_register_acf_color_palette');

if( function_exists('acf_add_options_page') ) {
	
    acf_add_options_page( array(

        'page_title' 	=> 'Reusable Block Settings',
        'parent' 	=> 'edit.php?post_type=wp_block',
    ) );
	
}