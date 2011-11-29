<?php
final class CZMGps extends CZBase
{
	/**
	 * @author Takamichi Yanai
	 */
	public function getLinkTag($url, $str)
	{
		return $this->_cz->newCore('gps', 'get_link_tag')->exec($url, $str);
	}

	/**
	 * @author Takamichi Yanai
	 */
	public function getLoc() {
		return $this->_cz->newCore('gps', 'get_loc')->exec();
	}

	/**
	 * @author Takamichi Yanai
	 */
	public function float2dms($locationfloat){
		return $this->_cz->newCore('gps', 'float_2_dms')->exec($locationfloat);
	}

	/**
	 * @author Takamichi Yanai
	 */
	public function dms2float($locationdms){
		return $this->_cz->newCore('gps', 'dms_2_float')->exec($locationdms);
	}

	/**
	 * @author Takamichi Yanai
	 */
	public function LocTokyo($loc) {
		return $this->_cz->newCore('gps', 'loc_tokyo')->exec($loc);
	}

	/**
	 * @author Takamichi Yanai
	 */
	public function LocWGS($loc) {
		return $this->_cz->newCore('gps', 'loc_wgs')->exec($loc);
	}
}
?>