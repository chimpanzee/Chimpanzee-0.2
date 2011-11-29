<?php
final class CZCmodelGetRowNum extends CZBase
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
		if (!($paging = $model_records->getPaging())) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_ENABLED_PAGING, '', $model_records->getModel()->getMainClassName());
		}
		
		$row_num = $this->_cz->newCore('request', 'get_param')->getGetParam($paging['row_num_param_name'], FALSE);
		
		return $row_num ? $row_num : $paging['default_row_num'];
	}
}
?>