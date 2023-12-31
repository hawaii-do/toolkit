<?php
namespace Toolkit\models;

class PublicationCategory extends Taxonomy {
    const TYPE = 'publication_category';

    public static function register() {
        register_taxonomy(self::TYPE, Publication::TYPE, [
            'hierarchical' => true,
            'show_admin_column' => true,
            'publicly_queryable' => false,
            'show_in_rest' => true,
            'labels' => [
                'name'              => __( 'Publikation Kategorie', ''),
                'singular_name'     => __( 'Kategorie', ''),
                'search_items'      => __( 'suche Kategorien', ''),
                'all_items'         => __( 'alle Kategorien', ''),
                'parent_item'       => __( 'übergeordneter Kategorie', ''),
                'parent_item_colon' => __( 'übergeordneter Kategorie:', ''),
                'edit_item'         => __( 'Kategorie bearbeiten', ''),
                'update_item'       => __( 'Kategorie aktualisieren', ''),
                'add_new_item'      => __( 'neue Kategorie', ''),
                'new_item_name'     => __( 'neuer Kategoriename', ''),
                'menu_name'         => __( 'Publikation Kategorien', ''),
            ]
        ]);
    }

}
