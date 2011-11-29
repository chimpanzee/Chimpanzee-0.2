<?php
final class CZCurlGetCGKey extends CZBase
{
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$key = $this->_cz->newCore('forward', 'get_ctrl_name')->exec();
		if (($action_group_name = $this->_cz->newCore('forward', 'get_action_group_name')->exec()) !== '') {
			$key .= ':' . $action_group_name;
		}
		
		return $key;
	}
}
?>