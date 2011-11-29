<?php
final class CZCfilterBase extends CZBase
{
	private $_funcs_class_name = '';
	
	
	/**
	 * @param array  $info
	 * @param string $subject
	 * @param array  $ref_values
	 * @param object $main
	 * @param object $funcs
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($info, $subject, $ref_values, $main, $funcs)
	{
		$main_class_name         = get_class($main);
		$this->_funcs_class_name = get_class($funcs);
		
		$validate_err_msg = $this->_cz->newUser('config', 'filter')->getValue('validate_err_msg', '');
		
		$infos = is_int(key($info)) ? $info : array($info);
		foreach ($infos as $info) {
			$params = array('subject' => $subject);
			if (isset($info['params'])) {
				foreach ($info['params'] as $param_name => $value) {
					if (is_array($value)) {
						if (!isset($value['ref'])) {
							$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FILTER_NOT_SET_REF, '', $main_class_name);
						}
						if (!isset($ref_values[$value['ref']])) {
							if ($main_class_name == 'CZCfilterConvert') {
								return '';
							}
							$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FILTER_NOT_SET_REF_VALUE, $value['ref'], $main_class_name);
						}
						$value = $ref_values[$value['ref']];
					}
					$params[$param_name] = $value;
				}
			}
			
			if (!isset($info['func'])) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FILTER_NOT_SET_FUNC, '', $main_class_name);
			}
			if (is_array($info['func'])) {
				list($class_name, $method_name) = $info['func'];
				$obj = new $class_name;
				$result = $obj->$method_name($params);
			} else {
				if (method_exists($funcs, $info['func'])) {
					$result = $funcs->$info['func']($this, $params);
				} else {
					if ($this->_cz->isValidStr($params['subject'])) {
						$result = $info['func']($params['subject']);
					} else {
						$result = '';
					}
				}
			}
			
			if ($main_class_name == 'CZCfilterValidate') {
				if ($this->_cz->isValidStr($result)) {
					if (isset($info['err_msg'])) {
						$result = $info['err_msg'];
					} else if ($this->_cz->isValidStr($validate_err_msg)) {
						$result = $validate_err_msg;
					}
					break;
				}
			} else {
				if (!$this->_cz->isValidStr($result)) {
					return '';
				}
				$subject = $result;
			}
		}
		
		return $result;
	}


	/**
	 * @param array $method_name
	 * @param array $params
	 * @param array $value_param_names
	 * @param array $option_param_names
	 * 
	 * @param boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function isExecFunc($method_name, $params, $value_param_names, $option_param_names = array())
	{
		$param_names = array_merge($value_param_names, $option_param_names);
		foreach ($param_names as $param_name) {
			if (!isset($params[$param_name])) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FILTER_NOT_SET_FUNC_PARAM, $param_name, $this->_funcs_class_name . '::' . $method_name);
			}
		}

		foreach ($value_param_names as $param_name) {
			$valid_str_flag = !$this->_cz->isValidStr($params[$param_name]);
			if (
				( $valid_str_flag && ($this->_funcs_class_name == 'CZCfilterConvertFuncs')) ||
				(!$valid_str_flag && ($this->_funcs_class_name == 'CZCfilterValidateFuncs'))
			) {
				return $this->_funcs_class_name == 'CZCfilterValidateFuncs';
			}
		}
		
		return $this->_funcs_class_name == 'CZCfilterConvertFuncs';
	}
}
?>