<?php
final class CZCmobileGetCarrierName extends CZBase
{
	/**
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if (preg_match('/^DoCoMo/', $_SERVER['HTTP_USER_AGENT'])) {
			$name = 'docomo';
		} else if (preg_match('/^KDDI|^UP.Browser/', $_SERVER['HTTP_USER_AGENT'])) {
			$name = 'au';
		} else if (preg_match('/^SoftBank|^Vodafone|^J-PHONE/', $_SERVER['HTTP_USER_AGENT'])) {
			$name = 'softbank';
		} else if (preg_match('/WILLCOM|DDIPOCKET/', $_SERVER['HTTP_USER_AGENT'])) {
			$name = 'willcom';
		} else {
			return FALSE;
		}
		
		return $name;
	}
}
?>