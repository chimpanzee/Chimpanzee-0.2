<?php
final class configForm extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'description_head_str' => '<font color="#0000FF">',
			'description_tail_str' => '</font>',

			'err_msg_head_str' => '<font color="#FF0000">',
			'err_msg_tail_str' => '</font>',
			
			'required_err_msg' => 'Please input it.',
			'confirm_err_msg'  => 'The content is not corresponding.',
		
			'upload_file_size_err_msg' => 'Please reduce the size of the file.',
			
			'pass_hide_str' => '********',
		));
	}
}
?>