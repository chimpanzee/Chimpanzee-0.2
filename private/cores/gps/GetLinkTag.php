<?php
final class CZCgpsGetLinkTag extends CZBase
{
	/**
	 * @author Takamichi Yanai
	 */
	public function exec($url, $str) {
		$GPSLink = '';
		$carrier = $this->_cz->newCore('mobile', 'get_carrier_name')->exec();

		switch($carrier) {
			case 'docomo': 
				$GPSLink = '<a href="'.$url.'" lcs>'.$str.'</a>';
				break;

			case 'softbank': 
				$GPSLink = '<a href="location:auto?url='.$url.'">'.$str.'</a>';
				break;

			case 'au': 
				$GPSLink = '<a href="device:gpsone?url='.$url.'&ver=1&datum=0&unit=0">'.$str.'</a>';
				break;

			case 'willcom': 
				$GPSLink = '<a href="http://location.request/dummy.cgi?my='.$url.'&pos=$location">'.$str.'</a>';
				break;

			default: 
				return FALSE;

		}

		return $GPSLink;
	}
}
?>