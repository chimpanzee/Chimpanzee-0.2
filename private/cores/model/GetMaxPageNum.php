<?php
final class CZCmodelGetMaxPageNum extends CZBase
{
	/**
	 * @param object $model_records
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model_records)
	{
		$record_num = $this->_cz->newCore('model', 'get_record_num')->exec($model_records);
		$row_num    = $this->_cz->newCore('model', 'get_row_num')->exec($model_records);
		
		return floor(($record_num + $row_num - 1) / $row_num);
	}
}
?>