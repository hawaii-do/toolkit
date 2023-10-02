<?php

namespace Toolkit\utils;

class AssetService
{

    const ASYNC_SCRIPTS = [];
    const DEFER_SCRIPTS = ["app"];


    public static function register()
    {
        add_action('wp_enqueue_scripts', [self::class, 'enqueue_styles']);
        add_action('wp_enqueue_scripts', [self::class, 'enqueue_scripts']);
        add_filter('script_loader_tag', [self::class, 'loader'], 10, 2);
    }

    public static function enqueue_styles()
    {
        wp_enqueue_style('app', get_stylesheet_directory_uri() . "/public/app.css", [], self::version("/app.css"));
    }

    public static function enqueue_scripts()
    {
        wp_register_script('app', get_stylesheet_directory_uri() . '/public/app.js', array( 'wp-i18n' ) , self::version("/app.js"), true);

        wp_localize_script('app', 'toolkit', [
            'base_url' => site_url(),
            'theme_url' => get_stylesheet_directory_uri(),
        ]);
        wp_enqueue_script('app');

        // wp_enqueue_script('my-script', get_stylesheet_directory_uri() . '/static/javascripts/my-script', [], false, true);
    }


    public static function loader($tag, $handle)
    {
        if (in_array($handle, self::ASYNC_SCRIPTS)) {
            $tag = str_replace(' src', ' async src', $tag);
        }

        if (in_array($handle, self::DEFER_SCRIPTS)) {
            $tag = str_replace(' src', ' defer src', $tag);
        }

        return $tag;
    }


    public static function version($file = null)
    {
        $path = get_theme_file_path() . "/public/mix-manifest.json";

        if (!file_exists($path)) {
            return null;
        }

        $manifest_content = file_get_contents($path);
        $manifest_json = json_decode($manifest_content, true);

        if ($file === null or !isset($manifest_json[$file])) {
            return md5($manifest_content);
        }

        $file_data = explode("?id=", $manifest_json[$file]);

        if (isset($file_data[1])) {
            return $file_data[1];
        }

        return null;
    }
}
