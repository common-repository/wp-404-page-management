<?php

if (!defined('ABSPATH')) die('No direct access allowed');

if (class_exists('Klick_404_Rate_Us')) return;

require_once(KLICK_404_PLUGIN_MAIN_PATH . '/includes/class-klick-404-abstract-notice.php');

/**
 * Class Klick_404_Rate_Us
 */
class Klick_404_Rate_Us extends Klick_404_Abstract_Notice {

	/**
	 * Klick_404_Rate_Us constructor
	 */
	public function __construct() {
		$this->notice_id = 'givemerate';
		$this->title = __('Please Rate 404 Page Management', 'klick-404');
		$this->klick_404 = "";
		$this->notice_text = __('If you could spare just a few minutes it would help us alot - thanks', 'klick-404');
		$this->image_url = '../images/our-more-plugins/404.svg';
		$this->dismiss_time = 'dismiss-page-notice-until';
		$this->dismiss_interval = 30;
		$this->display_after_time = 0;
		$this->dismiss_type = 'dismiss forever';
		$this->dismiss_text= __('I have already rated', 'klick-404');
		$this->position = 'top';
		$this->only_on_this_page = '';
		$this->button_link = 'https://wordpress.org/support/plugin/klick-404-logger/reviews/?rate=5#new-post';
		$this->button_text = __('Click Here', 'klick-404');
		$this->notice_template_file = 'horizontal-notice.php';
		$this->validity_function_param = '';
		$this->validity_function = '';
	}
}

