<?php
final class CZCurlGetRoot extends CZBase
{
	/**
	 * @param boolean $secure_flag <option>
	 * @param array   $params(
	 *   'routing' => array(
	 *     string Parameter value
	 *     ...
	 *   ) <option>
	 *   'get' => array(
	 *     string Parameter name => string Parameter value
	 *     ...
	 *   ) <option>
	 * ) <option>
	 * 
	 * @return string URL
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($secure_flag = NULL, $params = NULL)
	{
		if ($secure_flag === NULL) {
			$secure_flag = $this->_cz->newCore('url', 'is_secure')->exec();			
		}
		if ($this->_cz->newUser('config', 'url')->getValue('secure_ignore_flag', FALSE)) {
			$secure_flag = FALSE;
		}

		if (!($server_name = $this->_cz->newUser('config', 'url')->getValue('server_name', ''))) {
			$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost';
		}

		$url  = $secure_flag ? 'https' : 'http';
		$url .= '://' . $server_name;
		$url .= $this->_cz->newCore('url', 'get_path')->exec();
		if (isset($params['routing'])) {
			foreach ($params['routing'] as $value) {
				$url .= '/' . $value;
			}
		}
		if (isset($params['get'])) {
			$get_sentence = '';
			foreach ($params['get'] as $name => $value) {
				if ($get_sentence) {
					$get_sentence .= '&';
				}
				$get_sentence .= $name . '=' . urlencode($value);
			}
			$url .= '?' . $get_sentence;
		}

		return $url;
	}
}
?>