<?php
final class CZCmodelGetDetailHtml extends CZBase
{
	/**
	 * @param object $model
	 * @param array  $captions
	 * @param array  $record
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	private function _getCaptionAreas($model, $captions, $record)
	{
		if ($captions) {
			return $captions;
		}

		$caption_areas = array();
		$column_names = array_keys($record);
		foreach ($column_names as $column_name) {
			$caption_areas[$column_name] = $column_name;
		}
		
		return $caption_areas;
	}
	
	/**
	 * @param object $model
	 * @param array  $captions
	 * @param array  $record
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	private function _getDataAreas($model, $captions, $record)
	{
		$data_areas = array();
		if ($captions) {
			$column_names = array_keys($captions);
		} else {
			$column_names = array_keys($record);
		}
		foreach ($column_names as $column_name) {
			$data_areas[$column_name] = $this->_cz->newCore('view', 'convert')->exec($record[$column_name]);
		}
		
		return $data_areas;
	}
	
	/**
	 * @param object  $model
	 * @param integer $id
	 * 
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $id)
	{
		$captions = $model->getCaptions();
		$column_names = array();
		if (!($record = $this->_cz->newCore('model', 'get_record')->byId($model, $id, $column_names))) {
			return FALSE;
		}
		
		$caption_areas = self::_getCaptionAreas($model, $captions, $record);
		$data_areas    = self::_getDataAreas($model, $captions, $record);
		
		return $this->_cz->newCore('html', 'get_detail')->exec($caption_areas, $data_areas);
	}
}
?>