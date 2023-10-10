<?php

namespace Toolkit;

use Toolkit\utils\AssetService;
use Toolkit\models\Office;
use Toolkit\models\AuditCategory;
use Toolkit\models\AuditType;
use Toolkit\models\AuditTheme;
use Toolkit\models\Publication;
use Toolkit\models\PublicationCategory;

include("utils/main.php");

// custom post type
$toRegister = [
    AssetService::class,
    Office::class,
    AuditCategory::class,
    AuditType::class,
    AuditTheme::class,
    Publication::class,
    PublicationCategory::class,
];

foreach ($toRegister as $class) {
    $class::register();
}


// add image sizes
use Toolkit\utils\Size;

$size = Size::get_instance();
$size->init();
const FULL_SIZE = 99999;
add_filter('image_resize_dimensions', ['\\Toolkit\\utils\\Upscale', 'resize'], 10, 6);
add_action('init', function () {
    //Size::add(string $name, int $width, int $height, bool|array $crop = false);

    // Exemple full-width
    Size::add("image-xl-2x", 3840, FULL_SIZE, false);
    Size::add("image-xl", 1920, FULL_SIZE, false);
    Size::add("image-l-2x", 2560, FULL_SIZE, false);
    Size::add("image-l", 1280, FULL_SIZE, false);
    Size::add("image-m-2x", 1720, FULL_SIZE, false);
    Size::add("image-m", 860, FULL_SIZE, false);
    Size::add("image-s-2x", 800, FULL_SIZE, false);
    Size::add("image-s", 400, FULL_SIZE, false);
});


// add new size for wysiwyg
add_filter('image_size_names_choose', function ($sizes) {
    // "size_name" => "Label"
    return $sizes;
});


// register menu
register_nav_menus([
    "main_menu" => "Menu principal",
    "footer_menu" => "Menu pied de page"
]);



// register Gutenberg blocks
add_action('init', function () {
    wp_register_style(
        'gutenberg-editor-style',
        get_stylesheet_directory_uri() . '/public/blocks.css',
        array('wp-edit-blocks'),
        AssetService::version("/blocks.css")
    );

    wp_register_script(
        'gutenberg-editor-script',
        get_stylesheet_directory_uri() . '/public/blocks.js',
        ['wp-blocks', 'wp-element', 'wp-i18n', 'wp-polyfill', 'wp-editor', 'wp-block-editor'],
        AssetService::version("/blocks.js")
    );

    register_block_type('toolkit/sample-block', [
        'editor_script' => 'gutenberg-editor-script',
        'editor_style' => 'gutenberg-editor-style',
    ]);
});
