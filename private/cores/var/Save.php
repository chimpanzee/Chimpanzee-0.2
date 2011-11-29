<?php
final class CZCvarSave extends CZBase
{
	/**
	 * @param string $main_class_name
	 * @param string $var_name
	 * @param mixed  $value
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($main_class_name, $var_name, $value)
	{
		$values = $this->_cz->newCore('ses', 'get')->exec($main_class_name, array(), 'var');
		$values[$var_name] = $value;
		$this->_cz->newCore('ses', 'set')->exec($main_class_name, $values, 'var');
	}
}
?>