<?php
final class configSes extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'secure_flag' => TRUE,
		));
	}
}
?>