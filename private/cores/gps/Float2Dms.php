<?php
final class CZCgpsFloat_2_Dms extends CZBase
{
	/**
	 * @author Takamichi Yanai
	 */
	public function exec($locationfloat){
		$dd = $locationfloat;
		$mm = fmod($dd,1)*60;
		$ss = fmod($mm,1)*60;
		return intval($dd).'.'.intval($mm).'.'.round($ss,3);
	}
}
?>