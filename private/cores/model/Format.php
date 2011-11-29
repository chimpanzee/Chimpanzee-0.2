<?php
final class CZCmodelFormat extends CZBase
{
	/**
	 * @param object $model
	 * @param array  $record
	 * 
	 * @return array
	 *         
	 * @author Shin Uesugi
	 */
	public function exec($model, $record)
	{
		$formats = $model->getFormats();
		
		foreach ($formats as $column_name => $format) {
			if (!isset($record[$column_name])) {
				continue;
			}
			
			if (isset($format['convert'])) {
				$record[$column_name] = $this->_cz->newCore('filter', 'convert')->exec($format['convert'], $record[$column_name], $record);
			} else if (isset($format['table'])) {
				if (!isset($format['table'][$record[$column_name]])) {
					$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_SET_FORMAT_TABLE_VALUE, $record[$column_name], $model->getMainClassName());
				}
				$record[$column_name] = $format['table'][$record[$column_name]];
			}
			
			if (isset($format['head_str'])) {
				$record[$column_name] = $format['head_str'] . $record[$column_name];
			}
			if (isset($format['tail_str'])) {
				$record[$column_name] .=  $format['tail_str'];
			}
		}
		
		return $record;
	}
}
?>