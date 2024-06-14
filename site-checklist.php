<?php
/*
Plugin Name: Site Checklist
Description: An add-on for ACF plugin to create dynamic forms using custom fields.
Version: 1.0
Author: Yurii Nykolyshyn
Text Domain: site_checklist
Domain Path: /languages
*/

// Ensure ACF is active
if (!class_exists('ACF')) {
	add_action('admin_notices', function() {
		echo '<div class="error"><p>The Site Checklist plugin requires ACF to be activated.</p></div>';
	});
	return;
}

// Autoload Classes
spl_autoload_register(function ($class) {
	if (strpos($class, 'Site_Checklist') !== false) {
		include_once __DIR__ . '/includes/' . $class . '.php';
	}
});

// Initialize the plugin
add_action('plugins_loaded', ['Site_Checklist', 'get_instance']);