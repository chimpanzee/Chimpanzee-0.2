<?php
final class CZCdbGetRealTableName extends CZBase
{
	/**
	 * @param string $table_name
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($table_name)
	{
		if ($table_name{0} == '(') {
			return $table_name;
		}
		
		return $this->_cz->newUser('config', 'db')->getValue('table_name_prefix', '') . $table_name;
	}
}
?>