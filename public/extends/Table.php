<?php
class CZTable extends CZBase
{
	private $_main_class_name;
	
	private $_table = array();

	
	/**
	 * @param string $main_class_name
	 * 
	 * @author Shin Uesugi
	 */
	public function _setMainClassName($main_class_name)
	{
		$this->_main_class_name = $main_class_name;
	}
	

	/**
	 * @param array $table
	 * 
	 * @author Shin Uesugi
	 */
	protected function set($table)
	{
		$this->_table = $table;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function get()
	{
		if (!$this->_table) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_TABLE_NOT_SET_TABLE, '', $this->_main_class_name);
		}
		
		return $this->_table;
	}

	/**
	 * @param string $id
	 * @param string $default_value
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getValue($id, $default_value = NULL)
	{
		if (!isset($this->_table[$id])) {
			if ($default_value !== NULL) {
				return $default_value;
			}
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_TABLE_NOT_SET_ID, $id, $this->_main_class_name);
		}
		
		return $this->_table[$id];
	}
}
?>