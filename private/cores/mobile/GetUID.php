<?php
final class CZCmobileGetUID extends CZBase
{
	/**
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$uid = FALSE;
		$carrier_name = $this->_cz->newCore('mobile', 'get_carrier_name')->exec();
		switch ($carrier_name) {
			case 'docomo':
				if (preg_match('/^.+ser([0-9a-zA-Z]+)/', $_SERVER['HTTP_USER_AGENT'], $matches)) {
					$uid = $matches[1];
				}
				break;
			case 'au':
				if (isset($_SERVER['HTTP_X_UP_SUBNO'])) {
					$uid = $_SERVER['HTTP_X_UP_SUBNO'];
				}
				break;
			case 'softbank':
				if (preg_match('/^.+\/SN([0-9a-zA-Z]+)/', $_SERVER['HTTP_USER_AGENT'], $matches)) {
					$uid = $matches[1];
				}
				break;
		}
		
		return $uid;
	}
}
?>