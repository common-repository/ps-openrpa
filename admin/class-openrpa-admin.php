<?php
/**
 * PS OpenRPA Admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Admin Menu Class
 */
final class PS_OpenRPA_Admin {

	/**
	 * Initializes WordPress Hooks
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Enqueue Needed Styles Or Scripts Library
	 */
	public function enqueue( $hook_suffix ) {
		if ( 'toplevel_page_ps-openrpa' === $hook_suffix || str_starts_with( $hook_suffix, 'ps-openrpa_page' ) ) {
			wp_enqueue_script( 'bootstrap-js', plugins_url( 'assets/js/lib/bootstrap.min.js', __DIR__ ), array(), '5.3.0' );
			wp_enqueue_style( 'bootstrap-css', plugins_url( 'assets/css/lib/bootstrap.min.css', __DIR__ ), array(), '5.3.0' );
			wp_enqueue_script( 'lightbox-js', plugins_url( 'assets/js/lib/lightbox.js', __DIR__ ), array(), '2.11.4' );
			wp_enqueue_style( 'lightbox-css', plugins_url( 'assets/css/lib/lightbox.css', __DIR__ ), array(), '2.11.4' );
			wp_enqueue_script( 'ps-openrpa-js', plugins_url( 'assets/js/ps-openrpa-admin.js', __DIR__ ), array(), '1.0.0' );
			wp_enqueue_style( 'ps-openrpa-css', plugins_url( 'assets/css/ps-openrpa-admin.css', __DIR__ ), array(), '1.0.0' );
		}
	}

	/**
	 * Added Setting Menu Page
	 */
	public function admin_menu() {
		add_menu_page(
			'PS OpenRPA',
			'PS OpenRPA',
			'administrator', // role
			'ps-openrpa',
			array( $this, 'load_main_page' ),
			'dashicons-smiley'
		);

		add_submenu_page(
			'ps-openrpa', // parent slug
			'タスク登録',
			'タスク登録',
			'administrator', // role
			'ps-openrpa-task',
			array( $this, 'load_task_page' ),
		);

		add_submenu_page(
			'ps-openrpa', // parent slug
			'タスク実行履歴',
			'タスク実行履歴',
			'administrator', // role
			'ps-openrpa-history',
			array( $this, 'load_history_page' ),
		);
	}

	/**
	 * Load Main Page
	 */
	public function load_main_page() {
		include_once PS_OPENRPA_PATH . 'templates/top.php';
	}

	/**
	 * Load Task Registration Page
	 */
	public function load_task_page() {
		include_once PS_OPENRPA_PATH . 'templates/task.php';
	}

	/**
	 * Load History Page
	 */
	public function load_history_page() {
		include_once PS_OPENRPA_PATH . 'templates/history.php';
	}
}

new PS_OpenRPA_Admin();
