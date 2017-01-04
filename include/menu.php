<?php

	function showMenu() {

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
		echo '<ul id="nav">' . $menuHtml . '</ul><br/><br/><br/><br/>';
	}

?>
