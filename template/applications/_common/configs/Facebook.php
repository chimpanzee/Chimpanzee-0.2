<?php
final class configFacebook extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'app_id'           => '',
			'app_secret'       => '',
			'app_access_token' => '',

			'scope' => '',
		));
	}
}
?>