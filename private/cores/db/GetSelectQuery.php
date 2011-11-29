<?php
final class CZCdbGetSelectQuery extends CZBase
{
	/**
	 * @param string $table_name
	 * @param string $column_name / array
	 * @param array  $condition_sentences
	 * @param array  $options
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($table_name, $column_name = '', $condition_sentences = array(), $options = array())
	{
		$query = 'SELECT ';
		if (isset($options['distinct_flag']) && $options['distinct_flag']) {
			$query .= 'DISTINCT ';
		}
		if (is_array($column_name) && $column_name) {
			$query .= implode(',', $column_name);
		} else if ($this->_cz->isValidStr($column_name)) {
			$query .= $column_name;
		} else {
			$query .= '*';
		}
		$query .= ' FROM ' . $this->_cz->newCore('db', 'get_real_table_name')->exec($table_name);
		$query .= $this->_cz->newCore('db', 'get_where_query_part')->exec($condition_sentences);
		if (isset($options['group_column_names'])) {
			$query .= ' GROUP BY ' . implode(',', $options['group_column_names']);
		}
		if (isset($options['order_sentences'])) {
			$query .= ' ORDER BY ' . implode(',', $options['order_sentences']);
		}
		if (isset($options['limit'])) {
			$query .= ' LIMIT ' . $options['limit'];
		}
		if (isset($options['offset'])) {
			$query .= ' OFFSET ' . $options['offset'];
		}

		return $query;
	}
}
?>