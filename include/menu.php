<?php

	function getMenu() {
		$path = $_SERVER['DOCUMENT_ROOT'] . '/menu.json';
		$contents = file_get_contents($path);
		$menu = json_decode($contents, true);

		foreach(moduleList() as $module) {
			if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module . '/menu.json')) {
				$path = $_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module . '/menu.json';
				$contents = file_get_contents($path);
				$menu = array_merge_recursive($menu, json_decode($contents, true));
			}
		}

		return $menu;
	}

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

		echo '<ul id="nav">' . menu2html(getMenu()) . '</ul><br/><br/><br/><br/>';
	}

?>
