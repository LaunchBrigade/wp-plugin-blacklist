<?php

class AB_Plugin_Blacklist {
	/**
	 * Action GET variable for the current request
	 * @var String
	 */
	private $action;

	/**
	 * Plugin GET variable for the current request
	 * @var String
	 */
	private $plugin;

	/**
	 * [$blacklist description]
	 * @var Array
	 */
	private $blacklist;

	/**
	 * Ban message displayed after wp_die()
	 * @var [type]
	 */
	private $message;

	/**
	 * Parse necessary GET variables and the JSON blacklist
	 */
	public function __construct() {
		$this->action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
		$this->plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';

		$blacklist_json = file_get_contents( WPMU_PLUGIN_DIR . '/blacklist/assets/blacklist.json', true );
		$this->blacklist = json_decode( $blacklist_json );

		$message = file_get_contents( WPMU_PLUGIN_DIR . '/blacklist/assets/message.txt', true );
		$this->message = $message;
	}

	/**
	 * Check current plugin against blacklist
	 */
	public function runCheck() {
		if ( $this->action == 'install-plugin' or $this->action == 'activate' ) {
			$plugin_path_array = explode( '/', $this->plugin );
			$plugin_dir = $plugin_path_array[0];

			if ( in_array( $plugin_dir, $this->blacklist ) ) {
				wp_die($this->message);
			}
		}
	}
}

if ( is_admin() ) {
	if ( substr( $_SERVER['REQUEST_URI'], 0, 20 ) == '/wp-admin/update.php' or substr( $_SERVER['REQUEST_URI'], 0, 21 ) == '/wp-admin/plugins.php' ) {
		$blacklist = new AB_Plugin_Blacklist();
		$blacklist->runCheck();
	}
}
