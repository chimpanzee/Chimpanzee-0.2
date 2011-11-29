<?php
final class configLogin extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'auto_redirect' => array(
				'ctrl_name'         => 'login',
				'action_group_name' => '',
				'action_name'       => 'index',
				'secure_flag'       => TRUE,
			),
		));
	}
}
?>