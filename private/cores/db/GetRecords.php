<?php
final class CZCdbGetRecords extends CZBase
{
	/**
	 * @param string $table_name
	 * @param array  $column_names
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * @param array  $options
	 * 
	 * @return array
	 *         
	 * @author Shin Uesugi
	 */
	public function exec($table_name, $column_names = array(), $condition_sentences = array(), $condition_values = array(), $options = array())
	{
		$query      = $this->_cz->newCore('db', 'get_select_query')->exec($table_name, $column_names, $condition_sentences, $options);
		$param_list = $this->_cz->newCore('db', 'get_param_list')->exec($condition_values);
		
		$pdo_stmt = $this->_cz->newCore('db', 'request_prepare')->exec($query, $param_list, TRUE);

		return $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>