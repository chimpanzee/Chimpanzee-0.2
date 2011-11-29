<?php
final class CZCdbGetValue extends CZBase
{
	/**
	 * @param string $table_name
	 * @param array  $column_name
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return scalar / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($table_name, $column_name, $condition_sentences = array(), $condition_values = array())
	{
		$query      = $this->_cz->newCore('db', 'get_select_query')->exec($table_name, $column_name, $condition_sentences);
		$param_list = $this->_cz->newCore('db', 'get_param_list')->exec($condition_values);
		
		$pdo_stmt = $this->_cz->newCore('db', 'request_prepare')->exec($query, $param_list, TRUE);
		
		return $pdo_stmt->fetchColumn();
	}
}
?>