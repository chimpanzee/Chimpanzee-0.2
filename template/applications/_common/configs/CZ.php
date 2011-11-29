<?php
final class configCZ extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'obj_load_only' => FALSE,
			
			'develop_flag' => TRUE,
		
			'tmp_dir' => '',
		));
	}
}
?>