<?php
final class CZCgpsDms_2_Float extends CZBase
{
	/**
	 * @author Takamichi Yanai
	 */
	public function exec($locationdms){
		preg_match('/^([\+\-0-9]+)\.([0-9]+)\.([0-9.]+)$/', $locationdms, $matches);
		return $matches[1] + ($matches[2] / 60) + ($matches[3] / 60 / 60);
	}
}
?>