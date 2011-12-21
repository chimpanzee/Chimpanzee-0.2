<?php
final class CZCfacebookCallAppApi extends CZBase
{
	/**
	 * @param string  $path
	 * @param string  $method
	 * @param string  $params <option>
	 * @param string  $access_token <option>
	 * @param boolean $accesss_token_auto_flag <option>
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($path, $method, $params = NULL, $access_token = NULL, $accesss_token_auto_flag = FALSE)
	{
		$url  = 'https://graph.facebook.com/';
		$url .= $this->_cz->newUser('config', 'facebook')->getValue('app_id');
		$url .= $path;

		if (!$access_token) {
			$access_token = $this->_cz->newUser('config', 'facebook')->getValue('app_access_token', FALSE);
		}

		if (!($result = $this->_cz->newCore('facebook', 'call_api')->exec($url, $method, $params, $access_token)) && $accesss_token_auto_flag) {
			if (!($access_token = $this->_cz->newCore('facebook', 'get_app_access_token')->exec())) {
				return FALSE;
			}

			$result = $this->_cz->newCore('facebook', 'call_api')->exec($url, $method, $params, $access_token);
		}

		return $result;
	}
}
?>