<?php

namespace Toolkit\models;

abstract class CustomPostType extends PostType
{
    abstract public static function type_settings();

    public static function register()
    {
        register_post_type(static::TYPE, static::type_settings());
    }
}
