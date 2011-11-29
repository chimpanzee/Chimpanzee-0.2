<?php
final class CZCmodelInsert extends CZBase
{
	/**
	 * @param object $model
	 * @param array  $record
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $record)
	{
		$table_name = $model->getTableName();
		
		if (!$this->_cz->newCore('model', 'is_unique')->exec($model, $record)) {
			return FALSE;
		}
		
		return $this->_cz->newCore('db', 'insert')->exec($table_name, $record);
	}
}
?>