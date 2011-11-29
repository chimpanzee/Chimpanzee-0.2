<?php
final class CZCmodelGetPrevPageUrl extends CZBase
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
		
		if (($current_page_num = $this->_cz->newCore('model', 'get_current_page_num')->exec($model_records)) < 2) {
			return FALSE;
		}
		$prev_page_num = $current_page_num - 1;

		return $this->_cz->newCore('url', 'get_param')->exec(array($paging['page_num_param_name'] => $prev_page_num));
	}
}
?>