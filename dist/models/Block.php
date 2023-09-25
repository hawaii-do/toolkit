<?php

namespace Toolkit\models;

abstract class Block
{

    /*
        How to register a custom block

        const TYPE = 'numbers';

        public static function settings() {
            return [
                'title' => __('Chiffres-clés'),
                'description' => __('A custom number block.'),
                'mode' => 'auto',
                'align' => 'full',
                'icon' => 'admin-comments',
                'keywords' => ['numbers', 'quote'],
            ];
        }
    */

    protected $_data;

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public static function register()
    {
        $setting = static::settings();
        $setting["name"] = static::TYPE;
        $setting["render_callback"] = [static::class, "render"];

        acf_register_block($setting);

        $file = get_theme_file_path("partials/blocks/" . static::TYPE . ".php");
        if (!file_exists($file)) {
            throw new \Exception("Missing block template " . $file);
        }
    }

    public static function render($data)
    {
        echo \Toolkit\render_partial(join("/", ["blocks", static::TYPE]), ["block" => new static($data)]);
    }

    public function id()
    {
        return $this->_data["id"];
    }
}
