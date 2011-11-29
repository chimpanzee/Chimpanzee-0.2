<?php
final class CZCvarFree extends CZBase
{
	/**
	 * @param string $main_class_name
	 * @param string $var_name
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($main_class_name, $var_name)
	{
		if ($values = $this->_cz->newCore('ses', 'get')->exec($main_class_name, array(), 'var')) {
			unset($values[$var_name]);
			$this->_cz->newCore('ses', 'set')->exec($main_class_name, $values, 'var');
		}
	}
}
?>