<?php
final class CZCdbDelete extends CZBase
{
	/**
	 * @param string $table_name / array
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($table_name, $condition_sentences = array(), $condition_values = array())
	{
		$query = '';
		$table_names = is_array($table_name) ? $table_name : array($table_name);
		$where = $this->_cz->newCore('db', 'get_where_query_part')->exec($condition_sentences);
		foreach ($table_names as $table_name) {
			$query .= 'DELETE FROM ' . $this->_cz->newCore('db', 'get_real_table_name')->exec($table_name);
			$query .= $where;
			$query .= ';';
		}

		$param_list = $this->_cz->newCore('db', 'get_param_list')->exec($condition_values);
		
		$pdo_stmt = $this->_cz->newCore('db', 'request_prepare')->exec($query, $param_list);
		
		return $pdo_stmt->rowCount();
	}
}
?>