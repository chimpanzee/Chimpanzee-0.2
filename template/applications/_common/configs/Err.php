<?php
final class configErr extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'msg_head_str' => '<font color="#FF0000">',
			'msg_tail_str' => '</font>',
		));
	}
}
?>