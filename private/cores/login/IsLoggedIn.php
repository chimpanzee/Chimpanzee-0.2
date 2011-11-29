<?php
final class CZCloginIsLoggedIn extends CZBase
{
	/**
	 * @param array $condition_values(
	 *   string Column name => string Value
	 *   ...
	 * ) <option>
	 * 
	 * @return boolean / redirect
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($condition_values = NULL)
	{
		$success_flag = TRUE;
		if ($values = $this->_cz->newCore('login', 'get_values')->exec()) {
			if ($condition_values) {
				foreach ($condition_values as $column_name => $value) {
					if ($values[$column_name] != $value) {
						$success_flag = FALSE;
						break;
					}
				}
			}
		} else {
			$success_flag = FALSE;
		}
		
		$auto_redirect = $this->_cz->newUser('config', 'login')->getValue('auto_redirect', FALSE);
		if (!$success_flag && $auto_redirect) {
			if (!isset($auto_redirect['ctrl_name'])) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_LOGIN_NOT_SET_AUTO_REDIRECT_CTRL_NAME);
			}
			if (!isset($auto_redirect['action_name'])) {
				$auto_redirect['action_name'] = 'index';
			}
			if (!isset($auto_redirect['secure_flag'])) {
				$auto_redirect['secure_flag'] = TRUE;
			}
			
			$request_url = $this->_cz->newCore('url', 'get_request')->exec();
			$this->_cz->newCore('ses', 'set')->exec('auto_redirect_src_url', $request_url);
			
			if (isset($auto_redirect['action_group_name']) && $this->_cz->isValidStr($auto_redirect['action_group_name'])) {
				$this->_cz->newCore('redirect', 'action')->_exec(array($auto_redirect['action_name'], $auto_redirect['action_group_name'], $auto_redirect['ctrl_name']), $auto_redirect['secure_flag']);
			} else {
				$this->_cz->newCore('redirect', 'action')->exec(array($auto_redirect['action_name'], $auto_redirect['ctrl_name']), $auto_redirect['secure_flag']);
			}
		}
		
		return $success_flag;
	}
}
?>