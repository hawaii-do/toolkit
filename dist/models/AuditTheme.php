<?php
namespace Toolkit\models;

class AuditTheme extends Taxonomy {
    const TYPE = 'audit_theme';

    public static function register() {
        register_taxonomy(self::TYPE, AUDIT::TYPE, [
            'hierarchical' => true,
            'show_admin_column' => true,
            'publicly_queryable' => false,
            'show_in_rest' => true,
            'labels' => [
                'name'              => __( 'Thema', ''),
                'singular_name'     => __( 'Thema', ''),
                'search_items'      => __( 'suche Themen', ''),
                'all_items'         => __( 'alle Theme', ''),
                'parent_item'       => __( 'übergeordneter Thema', ''),
                'parent_item_colon' => __( 'übergeordneter Thema:', ''),
                'edit_item'         => __( 'Themen bearbeiten', ''),
                'update_item'       => __( 'Themen aktualisieren', ''),
                'add_new_item'      => __( 'neues Thema', ''),
                'new_item_name'     => __( 'neuer Themenname', ''),
                'menu_name'         => __( 'Themen', ''),
            ]
        ]);
    }

}
