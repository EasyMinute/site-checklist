<?php

class Site_Checklist_CPT {

	public static function register_custom_post_type() {
		$labels = array(
			'name'                  => _x('Forms', 'Post Type General Name', 'site_checklist'),
			'singular_name'         => _x('Form', 'Post Type Singular Name', 'site_checklist'),
			'menu_name'             => __('Forms', 'site_checklist'),
			'name_admin_bar'        => __('Form', 'site_checklist'),
			'add_new_item'          => __('Add New Form', 'site_checklist'),
			'new_item'              => __('New Form', 'site_checklist'),
			'edit_item'             => __('Edit Form', 'site_checklist'),
			'update_item'           => __('Update Form', 'site_checklist'),
			'items_list_navigation' => __('Forms list navigation', 'site_checklist'),
			'filter_items_list'     => __('Filter forms list', 'site_checklist'),
		);
		$args = array(
			'label'                 => __('Form', 'site_checklist'),
			'description'           => __('Custom post type for forms', 'site_checklist'),
			'labels'                => $labels,
			'supports'              => array('title', 'custom-fields'),
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'has_archive'           => true,
			'menu_icon'             => 'dashicons-feedback',
		);
		register_post_type('forms', $args);
	}
}
?>