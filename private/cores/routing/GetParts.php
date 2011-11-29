<?php
final class CZCroutingGetParts extends CZBase
{
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	private function _getUrlParts()
	{
		$parts = array();
		
		$url_path = $this->_cz->newCore('url', 'get_path')->exec();
		
		$src_parts = explode('/', str_replace($url_path, '', $_SERVER['REQUEST_URI']));
		foreach ($src_parts as $part) {
			if ($part !== '') {
				$parts[] = $part;
			}
		}
		
		return $parts;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$ctrl_name         = '';
		$action_group_name = '';
		$action_name       = '';
		$params            = array();
		
		$url_parts = self::_getUrlParts();
		$maybe_action_group_name = '';
		foreach ($url_parts as $num => $url_part) {
			if (preg_match('/[\?\.].*/', $url_part, $matches)) {
				if (($url_part = str_replace($matches[0], '', $url_part)) === '') {
					break;
				}
			}
			switch ($num) {
				case 0:
					if ($ctrl = $this->_cz->newUser('ctrl', $url_part)) {
						$ctrl_name = $url_part;
					} else {
						$params[] = $url_part;
					}
					break;
				case 1:
					if ($ctrl) {
						if (method_exists($ctrl, 'action' . $this->_cz->getUpperStr($url_part))) {
							$action_name = $url_part;
						} else {
							$maybe_action_group_name = $url_part;
						}
					} else {
						$params[] = $url_part;
					}
					break;
				case 2:
					if ($maybe_action_group_name) {
						if (method_exists($ctrl, $maybe_action_group_name . $this->_cz->getUpperStr($url_part))) {
							$action_group_name = $maybe_action_group_name;
							$action_name       = $url_part;
						} else if (method_exists($ctrl, $maybe_action_group_name . 'Index')) {
							$action_group_name = $maybe_action_group_name;
							$params[]          = $url_part;
						} else {
							$params[] = $maybe_action_group_name;
							$params[] = $url_part;
						}
						$maybe_action_group_name = '';
					} else {
						$params[] = $url_part;
					}
					break;
				default:
					$params[] = $url_part;
			}
		}
		if ($maybe_action_group_name) {
			if (method_exists($ctrl, $maybe_action_group_name . 'Index')) {
				$action_group_name = $maybe_action_group_name;
			} else {
				$params[] = $maybe_action_group_name;
			}
		}
		if (!$action_name) {
			$action_name = 'index';
		}

		return array(
			'ctrl_name'         => $ctrl_name,
			'action_group_name' => $action_group_name,
			'action_name'       => $action_name,
			'params'            => $params,
		);
	}
}
?>