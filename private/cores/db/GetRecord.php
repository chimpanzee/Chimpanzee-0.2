<?php
final class CZCdbGetRecord extends CZBase
{
	/**
	 * @param string $table_name
	 * @param array  $column_names
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($table_name, $column_names = array(), $condition_sentences = array(), $condition_values = array())
	{
		$query      = $this->_cz->newCore('db', 'get_select_query')->exec($table_name, $column_names, $condition_sentences);
		$param_list = $this->_cz->newCore('db', 'get_param_list')->exec($condition_values);
		
		$pdo_stmt = $this->_cz->newCore('db', 'request_prepare')->exec($query, $param_list, TRUE);
		
		return $pdo_stmt->fetch(PDO::FETCH_ASSOC);
	}
}
?>