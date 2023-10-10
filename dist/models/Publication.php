<?php
namespace Toolkit\models;
use Toolkit\models\Office;
use \DateTime;

class Publication extends CustomPostType
{
    const TYPE = 'publication';
    const SLUG = "publikation";

    public static function type_settings()
    {
        return [
            "menu_position" => 2.1,
            "label" => __("Publikation", "efk"),
            "labels" => [
                "name" => __("Publikationen", "efk"),
                "singular_name" => __("Publikation", "efk"),
                "menu_name" => __("Publikationen", "efk"),
                "all_items" => __("Alle Publikationen", "efk"),
                "add_new" => __("neue Publikation", "efk"),
                "add_new_item" => __("neue Publikation", "efk"),
                "edit_item" => __("Publikation bearbeiten", "efk"),
                "new_item" => __("neue Publikation", "efk"),
                "view_item" => __("ansicht Publikation", "efk"),
                "view_items" => __("ansicht Publikationen", "efk"),
                "search_items" => __("suche Publikationen", "efk")
            ],
            "description" => "Prüfungsberichte, Jahespberichte, Jahresprogramme, Fachtexte, etc.",
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
            "menu_icon" => "dashicons-editor-expand",
            "supports" => ["title", "editor", "thumbnail"],
        ];
    }

   public function audit_language()
   {
        return $this->acf("berichtsprache");
   }

   public function  office()
   {
        $id = $this->acf("amt");
        return new Office($id);
   }

   public function  has_documents()
   {
        return $this->acf("dokuments");
   }

   public function documents()
   {
        return $this->acf("dokuments");
   }

   public function audit_date(){
        $date = $this->acf("prufungsdatum");
        return new DateTime($date);
   }

   public function foobar(){
        return $this->acf("foobar");
   }



}