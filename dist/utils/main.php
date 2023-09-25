<?php

namespace Toolkit;

use Toolkit\utils\AssetService;

spl_autoload_register(function ($class) {
    $filename = explode('\\', $class);
    $namespace = array_shift($filename);

    array_unshift($filename, get_template_directory());

    if ($namespace === __NAMESPACE__) {
        include(implode(DIRECTORY_SEPARATOR, $filename) . '.php');
    }
});

if (wp_get_environment_type() === "production" and AssetService::version("/app.css") === null) {
    add_action('admin_notices', function () {
?>
        <div class="error notice notice-error">
            <p>Attention, le thème n'est pas compilé en mode <strong>production</strong>.</p>
        </div>
<?php
    });
}

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

// Remove admin toolbar comment icon
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
});


// remove unused menu
add_action('admin_menu', function () {
    //remove_menu_page('index.php');                    //Dashboard
    //remove_menu_page('edit.php');                     //Posts
    //remove_menu_page('upload.php');                   //Media
    //remove_menu_page('edit.php?post_type=page');      //Pages
    remove_menu_page('edit-comments.php');              //Comments
    //remove_menu_page('themes.php');                   //Appearance
    //remove_menu_page('plugins.php');                  //Plugins
    //remove_menu_page('users.php');                    //Users
    //remove_menu_page('tools.php');                    //Tools
    //remove_menu_page('options-general.php');          //Settings
    //remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category'); // Category
    //remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag'); // Etiquette
});

// set admin footer
add_action('admin_init', function () {
    add_filter('admin_footer_text', function () {
        echo 'Propulsé par <a href="https://hawaii.do/" target="_blank">Hawaii Interactive</a>';
    }, 11);

    add_editor_style('assets/css/editor.css');
});

// add thumbnails support
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');


    if (config("woocommerce_enabled")) {
        add_theme_support('woocommerce');
    }
});

// disable all actions related to emojis
add_action('init', function () {
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    add_filter('emoji_svg_url', '__return_false');
});

function render_partial($view, $data = [])
{
    extract($data);
    $path = [get_template_directory(), "partials", $view];
    ob_start();
    include(implode(DIRECTORY_SEPARATOR, $path) . '.php');
    return ob_get_clean();
}


function config(string $key, $default = null)
{
    $config = include(get_template_directory() . "/config/app.php");
    return $config[$key] ?? $default;
}

add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});


// updraft ignore dev files and folders
add_filter('updraftplus_exclude_directory', function ($filter, $directory) {
    $excludes = [
        ".git",
        ".vscode",
        "node_modules",
        "src"
    ];

    foreach ($excludes as $exclude) {
        if (strpos($directory, "wp-content/themes/" . $exclude)) {
            return true;
        }
    }

    return $filter;
}, 10, 2);

add_filter('updraftplus_exclude_file', function ($filter, $file) {
    $excludes = [
        ".editorconfig",
        ".gitignore",
        ".tool-versions",
        "config.example.json",
        "config.json",
        "package.json",
        "package-lock.json",
        "readme.md",
        "webpack.mix.js"
    ];

    foreach ($excludes as $exclude) {
        if (strpos($file, "wp-content/themes/" . $exclude)) {
            return true;
        }
    }

    return $filter;
}, 10, 2);

// remove WordPress version
add_filter('the_generator', function () {
    return '';
});

add_filter('style_loader_src', function ($src) {
    if (strpos($src, 'ver=' . get_bloginfo('version'))) {
        $src = remove_query_arg('ver', $src);
    }

    $src = str_replace("ver=", "", $src);
    return $src;
});
add_filter('script_loader_src', function ($src) {
    if (strpos($src, 'ver=' . get_bloginfo('version'))) {
        $src = remove_query_arg('ver', $src);
    }

    $src = str_replace("ver=", "", $src);
    return $src;
});

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');


// Upload limit for media library
add_filter('upload_size_limit', function ($_size) {
    return config("upload_size_limit", 5242880);
}, 20);


// disable auto-updates if mainwp is installed
$plugins = get_option('active_plugins', []);
if (in_array("mainwp-child/mainwp-child.php", $plugins)) {
    add_filter('auto_update_plugin', '__return_false');
    add_filter('gform_disable_auto_update', '__return_true', 50000);
    add_filter('option_gform_enable_background_updates', '__return_false', 50000);
}
