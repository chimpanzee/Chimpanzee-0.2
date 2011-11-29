<?php
final class CZCurlGetPath extends CZBase
{
	/**
	 * @return string URL path
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if ($path = $this->_cz->newUser('config', 'url')->getValue('path', '')) {
			return '/' . $path;
		}

		if (isset($_SERVER['REQUEST_URI'])) {
			if (strpos($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']) !== FALSE) {
				$path = $_SERVER['SCRIPT_NAME'];
			} else {
				$path = dirname($_SERVER['SCRIPT_NAME']);
			}
		} else {
			$path = '';
		}
		if ($path == '/') {
			$path = '';
		}

		return $path;
	}
}
?>