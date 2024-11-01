<?php

if (!defined('ABSPATH')) die('No direct access allowed');

if (class_exists('Klick_404_No_Config')) return;

require_once(KLICK_404_PLUGIN_MAIN_PATH . '/includes/class-klick-404-abstract-notice.php');

/**
 * Class Klick_404_No_Config
 */
class Klick_404_No_Config extends Klick_404_Abstract_Notice {
	
	/**
	 * Klick_404_No_Config constructor
	 */
	public function __construct() {
		$this->notice_id = 'User-Activity-Logger-configure';
		$this->title = __('404 Page Management plugin is installed but not configured', 'klick-404');
		$this->klick_404 = "";
		$this->notice_text = __('Configure it Now', 'klick-404');
		$this->image_url = '../images/our-more-plugins/404.svg';
		$this->dismiss_time = 'dismiss-page-notice-until';
		$this->dismiss_interval = 30;
		$this->display_after_time = 0;
		$this->dismiss_type = 'dismiss';
		$this->dismiss_text = __('Hide Me!', 'klick-404');
		$this->position = 'dashboard';
		$this->only_on_this_page = 'index.php';
		$this->button_link = KLICK_404_PLUGIN_SETTING_PAGE;
		$this->button_text = __('Click here', 'klick-404');
		$this->notice_template_file = 'main-dashboard-notices.php';
		$this->validity_function_param = '404-page-management/404-page-management.php';
		$this->validity_function = 'is_plugin_configured';
	}
}
