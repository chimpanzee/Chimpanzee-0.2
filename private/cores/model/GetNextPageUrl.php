<?php
final class CZCmodelGetNextPageUrl extends CZBase
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
		
		$current_page_num = $this->_cz->newCore('model', 'get_current_page_num')->exec($model_records);
		$max_page_num     = $this->_cz->newCore('model', 'get_max_page_num')->exec($model_records);
		if ($current_page_num >= $max_page_num) {
			return FALSE;
		}
		$next_page_num = $current_page_num + 1;

		return $this->_cz->newCore('url', 'get_param')->exec(array($paging['page_num_param_name'] => $next_page_num));
	}
}
?>