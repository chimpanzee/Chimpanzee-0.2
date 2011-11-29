<?php
final class CZCvarFreeAll extends CZBase
{
	/**
	 * @param string $main_class_name
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($main_class_name)
	{
		$this->_cz->newCore('ses', 'free')->exec($main_class_name, 'var');
	}
}
?>