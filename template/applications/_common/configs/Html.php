<?php
final class configHtml extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'form' => array(
				'html_type'   => 'table',	// 'table' / 'dl' / 'br'
				'tag_options' => array(
					'table' => 'border="1" width="700"',
					'tr'    => '',
					'th'    => 'width="30%"',
					'td'    => 'width="70%"',
				),
				'caption_head_str' => '<font color="#FF7700">*</font>',
				'caption_tail_str' => '',
			),
			
			'confirm' => array(
				'html_type'   => 'table',
				'tag_options' => array(
					'table' => 'border="1" width="700"',
					'tr'    => '',
					'th'    => 'width="30%"',
					'td'    => 'width="70%"',
				),
				'caption_head_str' => '<font color="#FF7700">*</font>',
				'caption_tail_str' => '',
			),
			
			'list' => array(
				'html_type'   => 'table',
				'tag_options' => array(
					'table' => 'border="1" width="100%"',
					'tr'    => '',
					'th'    => '',
					'td'    => '',
				),
				'caption_head_str' => '',
				'caption_tail_str' => '',
			),
			
			'detail' => array(
				'html_type'   => 'table',
				'tag_options' => array(
					'table' => 'border="1" width="700"',
					'tr'    => '',
					'th'    => 'width="30%"',
					'td'    => 'width="70%"',
				),
				'caption_head_str' => '<font color="#FF7700">*</font>',
				'caption_tail_str' => '',
			),
		));
	}
}
?>