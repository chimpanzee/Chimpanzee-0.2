<?php
final class CZCfacebookGetUserAccessToken extends CZBase
{
	/**
	 * @param string $app_id
	 * @param string $redirect_uri
	 * 
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	private function _getAuthCode($app_id, $redirect_uri)
	{
		$params = $this->_cz->newCore('request', 'get_param')->getGetParams();

		if (isset($params['error'])) {
			return FALSE;
		}

		if (!isset($params['code'])) {
			$state = md5(uniqid(rand(), TRUE));
			$this->_cz->newCore('ses', 'set')->exec('facebook_state', $state);

			$url  = 'https://www.facebook.com/dialog/oauth';
			$url .= '?state='        . $state;
			$url .= '&client_id='    . $app_id;
			$url .= '&redirect_uri=' . $redirect_uri;
			if ($scope = $this->_cz->newUser('config', 'facebook')->getValue('scope', FALSE)) {
				$url .= '&scope=' . $scope;
			}

			$this->_cz->newCore('redirect', 'url')->exec($url);
		}

		$state = $this->_cz->newCore('ses', 'get')->exec('facebook_state');
		$this->_cz->newCore('ses', 'free')->exec('facebook_state');

		if (!isset($params['state']) || ($params['state'] != $state)) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FACEBOOK_ILLEGAL_ACCESS);
		}

		return $params['code'];
	}

	/**
	 * @param $expires_return_flag <option>
	 * 
	 * @return string / array / FALSE
	 * array(
	 *   'access_token' => string
	 *   'expires'      => string
	 * )
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($expires_return_flag = FALSE)
	{
		$app_id       = $this->_cz->newUser('config', 'facebook')->getValue('app_id');
		$app_secret   = $this->_cz->newUser('config', 'facebook')->getValue('app_secret');
		$redirect_uri = $this->_cz->newCore('url', 'get_self')->exec(TRUE);

		if (!($auth_code = self::_getAuthCode($app_id, $redirect_uri))) {
			return FALSE;
		}

		$url  = 'https://graph.facebook.com/oauth/access_token';
		$url .= '?client_id='     . $app_id;
		$url .= '&redirect_uri='  . $redirect_uri;
		$url .= '&client_secret=' . $app_secret;
		$url .= '&code='          . $auth_code;

		if (!($result = @file_get_contents($url))) {
			return FALSE;
		}

		$values = NULL;
		parse_str($result, $values);

		return $expires_return_flag ? $values : $values['access_token'];
	}
}
?>