<?php
final class CZCmobileIsMobile extends CZBase
{
	/**
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if (!$this->_cz->newUser('config', 'mobile')->getValue('enable_flag', FALSE)) {
			return FALSE;
		}
		if ($this->_cz->newUser('config', 'mobile')->getValue('force_flag', FALSE)) {
			return TRUE;
		}
		
		return $this->_cz->newCore('mobile', 'get_carrier_name')->exec() !== FALSE;
	}
}
?>