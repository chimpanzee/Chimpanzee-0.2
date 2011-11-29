<?php
final class configMobile extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'enable_flag' => FALSE,
			'force_flag'  => FALSE,
		));
	}
}
?>