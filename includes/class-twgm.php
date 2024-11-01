<?php

class TWGM {
	
	protected $loader;
	protected $plugin_name;
	protected $ver;

	public function __construct ( ) {
		$this->plugin_name = 'twgm';
		$this->ver = '1.0.0';

		$this->load_depedencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function load_depedencies ( ) {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-twgm-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-twgm-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-twgm-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-twgm-public.php';
		$this->loader = new TWGM_Loader();
	}

	private function set_locale ( ) {
		$plugin_i18n = new TWGM_i18n();
		$this->loader->add_action( 'plugin_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	private function define_admin_hooks ( ) {
		$plugin_admin = new TWGM_Admin( $this->get_plugin_name(), $this->get_ver() );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	private function define_public_hooks ( ) {
		$plugin_public = new TWGM_Public( $this->get_plugin_name(), $this->get_ver() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		add_shortcode( 'twgm', array( $plugin_public, 'shortcode_handler' ) );
	}

	public function run ( ) {
		$this->loader->run();
	}

	public function get_plugin_name ( ) {
		return $this->plugin_name;
	}

	public function get_loader ( ) {
		return $this->loader;
	}

	public function get_ver ( ) {
		return $this->ver;
	}

}

?>