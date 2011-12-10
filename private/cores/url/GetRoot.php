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
		$url  = $this->_cz->newCore('url', 'get_protocol')->exec($secure_flag);
		$url .= '://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost');
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