<?php
/**
 * Spot Theme Sidebar
 *
 * @package SpotTheme
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2015
 * @link http://www.thinkglobalschool.org
 *
 */

// drop-down login
echo elgg_view('core/account/login_dropdown');

?>

<a class="elgg-button-nav" rel="toggle" href=".elgg-nav-collapse">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>

<div class="elgg-nav-collapse">
	<?php echo elgg_view_menu('site'); ?>
</div>
