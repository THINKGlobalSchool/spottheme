<?php
/**
 * Spot Theme Header
 *
 * @package SpotTheme
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2015
 * @link http://www.thinkglobalschool.org
 *
 */

// link back to main site.
echo elgg_view('page/elements/header_logo', $vars);

// drop-down login
//echo elgg_view('core/account/login_dropdown');

// insert site-wide navigation
//echo elgg_view_menu('site');