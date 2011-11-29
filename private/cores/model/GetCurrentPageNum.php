<?php
final class CZCmodelGetCurrentPageNum extends CZBase
{
	/**
	 * @param object $model_records
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model_records)
	{
		if (!($paging = $model_records->getPaging())) {
			return FALSE;
		}
		
		$page_num = $this->_cz->newCore('request', 'get_param')->getGetParam($paging['page_num_param_name'], FALSE);
		
		return $page_num ? $page_num : 1;
	}
}
?>