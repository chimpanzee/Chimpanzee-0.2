<?php
final class configModel extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'link_to_detail_str' => 'Detail',
			'link_to_update_str' => 'Update',
			'link_to_delete_str' => 'Delete',
		));
	}
}
?>