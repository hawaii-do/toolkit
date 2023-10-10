<?php
namespace Toolkit\models;
use Toolkit\models\Office;
use \DateTime;

class Direction extends CustomPostType
{
    const TYPE = 'direction';
    const SLUG = "leitung-und-stab";

    public static function type_settings()
    {
        return [
            "menu_position" => 2.4,
            "label" => __("Leitung und Stab", "efk"),
            "labels" => [
                "name" => __("Leitung und Stab", "efk"),
                "singular_name" => __("Leitung und Stab", "efk"),
                "menu_name" => __("Leitung un Stab", "efk"),
                "all_items" => __("Alle", "efk"),
                "add_new" => __("neue", "efk"),
                "add_new_item" => __("neue", "efk"),
                "edit_item" => __("bearbeiten", "efk"),
                "new_item" => __("neue", "efk"),
                "view_item" => __("ansicht", "efk"),
                "view_items" => __("ansicht", "efk"),
                "search_items" => __("suche", "efk")
            ],
            "description" => "Leitung und Stab",
            "public" => false,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "show_in_nav_menus" => true,
            "rest_base" => "",
            "has_archive" => true,
            "show_in_menu" => true,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => ["slug" => self::SLUG, "with_front" => false],
            "query_var" => true,
            "menu_icon" => "dashicons-shield-alt",
            "supports" => ["title", "editor", "thumbnail"],
        ];
    }

}