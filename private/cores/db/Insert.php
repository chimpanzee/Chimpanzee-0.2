<?php
final class CZCdbInsert extends CZBase
{
	/**
	 * @param string $table_name
	 * @param array  $record
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($table_name, $record)
	{
		$value = current($record);
		if (is_array($value) && is_integer(key($record))) {
			$set_column_names = array_keys($value);
		} else {
			$set_column_names = array_keys($record);
		}

		$param_list = $this->_cz->newCore('db', 'get_param_list')->exec($record);

		$query  = 'INSERT INTO ' . $this->_cz->newCore('db', 'get_real_table_name')->exec($table_name);
		$query .= ' (' . implode(',', $set_column_names) . ')';
		$query .= $this->_cz->newCore('db', 'get_values_query_part')->exec($param_list);

		$pdo_stmt = $this->_cz->newCore('db', 'request_prepare')->exec($query, $param_list);

		return $pdo_stmt->rowCount();
	}
}
?>