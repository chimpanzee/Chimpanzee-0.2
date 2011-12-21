<?php
final class CZCfacebookCallApi extends CZBase
{
	/**
	 * @param string $url
	 * @param string $method
	 * @param array  $params <option>
	 * @param string $access_token <option>
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($url, $method, $params = NULL, $access_token = NULL)
	{
		if ($access_token) {
			$url .= preg_match('/\?/', $url) ? '&' : '?';
			$url .= 'access_token=' . $access_token;
		}

		$options = array(
			'http' => array(
			    'method' => strtoupper($method),
			),
		);
		if ($params) {
			$options['http']['content'] = http_build_query($params);
		}

		if (!($json = @file_get_contents($url, FALSE, stream_context_create($options)))) {
			return FALSE;
		}

		return json_decode($json, TRUE);
	}
}
?>