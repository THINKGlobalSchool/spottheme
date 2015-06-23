<?php
/**
 * Spot Theme Start.php
 *
 * @package SpotTheme
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2015
 * @link http://www.thinkglobalschool.org
 */
elgg_register_event_handler('init','system','spot_theme_init');

function spot_theme_init() {
	// Extend pagesetup
	elgg_register_event_handler('pagesetup', 'system', 'spot_theme_page_setup', 1000);

	// Register Theme CSS
	elgg_extend_view('css/elgg', 'spottheme/css');

	// Register jquery ui CSS
	$ui_url = elgg_get_site_url() . 'mod/spottheme/vendors/smoothness/jquery-ui-1.10.4.custom.css';
	elgg_register_css('jquery.ui.smoothness', $ui_url);
	elgg_load_css('jquery.ui.smoothness');

	elgg_register_plugin_hook_handler('head', 'page', 'spot_theme_setup_head');

	// non-members do not get visible links to RSS feeds
	if (!elgg_is_logged_in()) {
		elgg_unregister_plugin_hook_handler('output:before', 'layout', 'elgg_views_add_rss_link');
	}

}

/**
 * Rearrange menu items
 */
function spot_theme_page_setup() {

	if (elgg_is_logged_in()) {

		elgg_register_menu_item('topbar', array(
			'name' => 'account',
			'text' => elgg_echo('account'),
			'href' => "#",
			'priority' => 100,
			'section' => 'alt',
			'link_class' => 'elgg-topbar-dropdown',
		));

		if (elgg_is_active_plugin('dashboard')) {
			$item = elgg_unregister_menu_item('topbar', 'dashboard');
			if ($item) {
				$item->setText(elgg_echo('dashboard'));
				$item->setSection('default');
				elgg_register_menu_item('site', $item);
			}
		}
		
		$item = elgg_get_menu_item('topbar', 'usersettings');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('settings'));
			$item->setPriority(103);
		}

		$item = elgg_get_menu_item('topbar', 'logout');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('logout'));
			$item->setPriority(104);
		}

		$item = elgg_get_menu_item('topbar', 'administration');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('admin'));
			$item->setPriority(101);
		}

		if (elgg_is_active_plugin('site_notifications')) {
			$item = elgg_get_menu_item('topbar', 'site_notifications');
			if ($item) {
				$item->setParentName('account');
				$item->setText(elgg_echo('site_notifications:topbar'));
				$item->setPriority(102);
			}
		}

		if (elgg_is_active_plugin('reportedcontent')) {
			$item = elgg_unregister_menu_item('footer', 'report_this');
			if ($item) {
				$item->setText(elgg_view_icon('report-this'));
				$item->setPriority(500);
				$item->setSection('default');
				elgg_register_menu_item('extras', $item);
			}
		}
	}
}

/**
 * Register items for the html head
 *
 * @param string $hook Hook name ('head')
 * @param string $type Hook type ('page')
 * @param array  $data Array of items for head
 * @return array
 */
function spot_theme_setup_head($hook, $type, $data) {
	$data['metas'][] = array(
		'name' => 'viewport',
		'content' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0',
	);
    
    // https://developer.chrome.com/multidevice/android/installtohomescreen
    $data['metas'][] = array(
        'name' => 'mobile-web-app-capable',
        'content' => 'yes',
    );

    $data['metas'][] = array(
        'name' => 'apple-mobile-web-app-capable',
        'content' => 'yes',
    );

	$data['links'][] = array(
		'rel' => 'apple-touch-icon',
		'href' => elgg_normalize_url('mod/spottheme/graphics/homescreen.png'),
	);

	return $data;
}
