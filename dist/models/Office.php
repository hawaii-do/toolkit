<?php
namespace Toolkit\models;

class Office extends CustomPostType
{
    const TYPE = 'office';
    const SLUG = "office";

    public static function type_settings()
    {
        return [
            "menu_position" => 2.2,
            "label" => __("Ämter", "efk"),
            "labels" => [
                "name" => __("Ämter", "efk"),
                "singular_name" => __("Amt", "efk"),
                "menu_name" => __("Ämter", "efk"),
                "all_items" => __("Ämter", "efk"),
                "add_new" => __("neues Amt", "efk"),
                "add_new_item" => __("neues Amt", "efk"),
                "edit_item" => __("Amt bearbeiten", "efk"),
                "new_item" => __("neues Amt", "efk"),
                "view_item" => __("ansicht Amt", "efk"),
                "view_items" => __("ansicht Ämter", "efk"),
                "search_items" => __("suche Ämter", "efk")
            ],
            "description" => "Geprüftes Amt",
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
            "menu_icon" => "dashicons-admin-multisite",
            "supports" => ["title", "editor", "thumbnail"],
        ];
    }

    public function kurzel()
    {
        return $this->acf("kurzel");
    }
}