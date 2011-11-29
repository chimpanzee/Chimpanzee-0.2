<?php
final class CZMMobile extends CZBase
{
	/**
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function isMobile()
	{
		return $this->_cz->newCore('mobile', 'is_mobile')->exec();
	}

	
	/**
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getCarrierName()
	{
		return $this->_cz->newCore('mobile', 'get_carrier_name')->exec();
	}


	/**
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getUID()
	{
		return $this->_cz->newCore('mobile', 'get_UID')->exec();
	}
}
?>