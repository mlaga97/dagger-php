<?php

	/**
	 * Loads and displays menu from menu.json configuration files.
	 *
	 * This function uses the getConfig function from config.php in order to
	 * load and merge the menu structure data from available modules.
	 *
	 *
	 * Menu item keys:
	 *
	 * | Key                               | Type       |
	 * |-----------------------------------|------------|
	 * | name                              | string     |
	 * | href                              | string     |
	 * | displayOnlyIfThisSessionKeyIsTrue | string     |
	 * | children                          | menuItem[] |
	 *
	 *
	 * Example menu.json stanza:
	 *
	 * 		"edu.usm.dagger.menu.example_menu": {
	 * 			"name": "Clinic Statistics",
	 * 			"href": "/clinicStatistics.php",
	 * 			"displayOnlyIfThisSessionKeyIsTrue": "admin",
	 * 			"children": {
	 * 			}
	 * 		}
	 */
	function showMenu() {

		// This function is pretty much only useful here, so it will remain.
		function menu2html($menu) {
			$html = '';

			foreach($menu as $menuItemId => $menuItem) {
				if(array_key_exists('displayOnlyIfThisSessionKeyIsTrue', $menuItem)) {
					if(!$_SESSION[$menuItem['displayOnlyIfThisSessionKeyIsTrue']]) {
						continue;
					}
				}

				$html .= '<li><a href="' . $menuItem['href'] . '">' . $menuItem['name'] . '</a>';
				if(array_key_exists('children', $menuItem)) {
					$html .= '<ul>' . menu2html($menuItem['children']) . '</ul>';
				}
				$html .= '</li>';
			}

			return $html;
		}

		$menuData = getConfig('menu.json');
		$menuHtml = menu2html($menuData);
		echo '<ul id="nav">' . $menuHtml . '</ul><br/>';
	}

?>
