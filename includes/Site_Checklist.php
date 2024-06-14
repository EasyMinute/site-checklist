<?php

class Site_Checklist {

	private static $instance = null;

	private function __construct() {
		$this->includes();
		$this->init_hooks();
	}

	public static function get_instance() {
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function includes() {
		include_once __DIR__ . '/Site_Checklist_CPT.php';
		include_once __DIR__ . '/Site_Checklist_Settings.php';
		include_once __DIR__ . '/Site_Checklist_Shortcode.php';
	}

	private function init_hooks() {
		add_action('init', ['Site_Checklist_CPT', 'register_custom_post_type']);
		add_action('admin_menu', ['Site_Checklist_Settings', 'add_admin_menu']);
		add_action('admin_init', ['Site_Checklist_Settings', 'settings_init']);
		add_action( 'acf/include_fields', ['Site_Checklist_Settings', 'add_acf_fields']);
		add_shortcode('proacto_form', ['Site_Checklist_Shortcode', 'render_form_shortcode']);

		// Enqueue frontend scripts and styles
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);

		// Enqueue admin scripts and styles
//		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
	}

	public function enqueue_scripts() {
		wp_enqueue_style('site-checklist-style', plugin_dir_url(__FILE__) . '../assets/css/site-checklist.css', [], '1.0.0', 'all');
		wp_enqueue_script('site-checklist-script', plugin_dir_url(__FILE__) . '../assets/js/site-checklist.js', ['jquery'], '1.0.0', true);
	}

//	public function enqueue_admin_scripts() {
//		wp_enqueue_style('site-checklist-admin-style', plugin_dir_url(__FILE__) . '../assets/css/site-checklist-admin.css', [], '1.0.0', 'all');
//		wp_enqueue_script('site-checklist-admin-script', plugin_dir_url(__FILE__) . '../assets/js/site-checklist-admin.js', ['jquery'], '1.0.0', true);
//	}
}
?>