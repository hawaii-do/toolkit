<?php
namespace Toolkit\models;
use Toolkit\models\Office;
use \DateTime;

class Job extends CustomPostType
{
    const TYPE = 'jobs';
    const SLUG = "vakanzen";

    public static function type_settings()
    {
        return [
            "menu_position" => 2.3,
            "label" => __("Vakanzen", "efk"),
            "labels" => [
                "name" => __("Vakanzen", "efk"),
                "singular_name" => __("Vakanz", "efk"),
                "menu_name" => __("Vakanzen", "efk"),
                "all_items" => __("Alle Vakanzen", "efk"),
                "add_new" => __("neuer Vakanz", "efk"),
                "add_new_item" => __("neuer Vakanz", "efk"),
                "edit_item" => __("Vakanz bearbeiten", "efk"),
                "new_item" => __("neuer Vakanz", "efk"),
                "view_item" => __("ansicht Vakanz", "efk"),
                "view_items" => __("ansicht Vakanzen", "efk"),
                "search_items" => __("suche Vakanzen", "efk")
            ],
            "description" => "Vakanzen, Stellenangebote, etc.",
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
            "menu_icon" => "dashicons-id-alt",
            "supports" => ["title", "editor", "thumbnail"],
        ];
    }

}