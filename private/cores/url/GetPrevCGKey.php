<?php
final class CZCurlGetPrevCGKey extends CZBase
{
	/**
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if (($key = $this->_cz->newCore('forward', 'get_prev_ctrl_name')->exec()) === '') {
			return FALSE;
		}
		if (($action_group_name = $this->_cz->newCore('forward', 'get_prev_action_group_name')->exec()) !== '') {
			$key .= ':' . $action_group_name;
		}
		
		return $key;
	}
}
?>