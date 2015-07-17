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
	// Register Theme CSS
	elgg_extend_view('css/elgg', 'spottheme/css');

	// Register jquery ui CSS
	$ui_url = elgg_get_site_url() . 'mod/spottheme/vendors/smoothness/jquery-ui-1.10.4.custom.css';
	elgg_register_css('jquery.ui.smoothness', $ui_url);
	elgg_load_css('jquery.ui.smoothness');

	// non-members do not get visible links to RSS feeds
	if (!elgg_is_logged_in()) {
		elgg_unregister_plugin_hook_handler('output:before', 'layout', 'elgg_views_add_rss_link');
	}
}