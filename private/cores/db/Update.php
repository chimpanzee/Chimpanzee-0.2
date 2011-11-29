<?php
final class CZCdbUpdate extends CZBase
{
	/**
	 * @param string $table_name
	 * @param array  $records
	 * @param array  $column_names
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	private function _replace($table_name, $records, $column_names)
	{
		$param_list = $this->_cz->newCore('db', 'get_param_list')->exec($records);
		
		$query  = 'REPLACE INTO ' . $this->_cz->newCore('db', 'get_real_table_name')->exec($table_name);
		$query .= ' (' . implode(',', $column_names) . ')';
		$query .= $this->_cz->newCore('db', 'get_values_query_part')->exec($param_list);

		$pdo_stmt = $this->_cz->newCore('db', 'request_prepare')->exec($query, $param_list);
		
		return $pdo_stmt->rowCount();
	}
	
	/**
	 * @param string $table_name
	 * @param array  $record
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($table_name, $record, $condition_sentences = array(), $condition_values = array())
	{
		$value = current($record);
		if (is_array($value) && is_integer(key($value))) {
			$column_names = array_keys($value);
			return self::_replace($table_name, $record, $column_names);
		}
		
		$query  = 'UPDATE ' . $this->_cz->newCore('db', 'get_real_table_name')->exec($table_name);
		$query .= $this->_cz->newCore('db', 'get_set_query_part')->exec($record);
		$query .= $this->_cz->newCore('db', 'get_where_query_part')->exec($condition_sentences);
		
		$values = $record;
		if ($condition_values) {
			$values = array_merge($values, $condition_values);
		}
		$param_list = $this->_cz->newCore('db', 'get_param_list')->exec($values);

		$pdo_stmt = $this->_cz->newCore('db', 'request_prepare')->exec($query, $param_list);
		
		return $pdo_stmt->rowCount();
	}
}
?>