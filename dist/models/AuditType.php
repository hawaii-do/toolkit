<?php
namespace Toolkit\models;

class AuditType extends Taxonomy {
    const TYPE = 'audit_type';

    public static function register() {
        register_taxonomy(self::TYPE, Publication::TYPE, [
            'hierarchical' => true,
            'show_admin_column' => true,
            'publicly_queryable' => false,
            'show_in_rest' => true,
            'labels' => [
                'name'              => __( 'Typ', ''),
                'singular_name'     => __( 'Typ', ''),
                'search_items'      => __( 'suche Typen', ''),
                'all_items'         => __( 'alle Typen', ''),
                'parent_item'       => __( 'übergeordneter Typ', ''),
                'parent_item_colon' => __( 'übergeordneter Typ:', ''),
                'edit_item'         => __( 'Typ bearbeiten', ''),
                'update_item'       => __( 'Typ aktualisieren', ''),
                'add_new_item'      => __( 'neuer Type', ''),
                'new_item_name'     => __( 'neuer Typenname', ''),
                'menu_name'         => __( 'Typen', ''),
            ]
        ]);
    }

}
