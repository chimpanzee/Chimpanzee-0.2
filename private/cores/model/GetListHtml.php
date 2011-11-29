<?php
final class CZCmodelGetListHtml extends CZBase
{
	/**
	 * @param object  $model_records
	 * @param array   $captions
	 * @param array   $records
	 * @param boolean $link_to_detail_flag
	 * @param boolean $link_to_update_flag
	 * @param boolean $link_to_delete_flag
	 * @param boolean $add_id_column_flag
	 * @param string  $id_column_name
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	private function _getCaptionAreas($model_records, $captions, $records, $link_to_detail_flag, $link_to_update_flag, $link_to_delete_flag, $add_id_column_flag, $id_column_name)
	{
		if (!$captions && !$records) {
			return FALSE;
		}
		
		if ($captions) {
			$caption_areas = $captions;
		} else {
			$caption_areas = array();
			$column_names = array_keys(current($records));
			foreach ($column_names as $column_name) {
				if ($add_id_column_flag && ($column_name == $id_column_name)) {
					continue;
				}
				$caption_areas[$column_name] = $column_name;
			}
		}
		if ($link_to_detail_flag) {
			$caption_areas['__detail__'] = '';
		}
		if ($link_to_update_flag) {
			$caption_areas['__update__'] = '';
		}
		if ($link_to_delete_flag) {
			$caption_areas['__delete__'] = '';
		}
		
		return $caption_areas;
	}
	
	/**
	 * @param object  $model_records
	 * @param array   $captions
	 * @param array   $records
	 * @param boolean $link_to_detail_flag
	 * @param boolean $link_to_update_flag
	 * @param boolean $link_to_delete_flag
	 * @param boolean $add_id_column_flag
	 * @param string  $id_column_name
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	private function _getDataAreasList($model_records, $captions, $records, $link_to_detail_flag, $link_to_update_flag, $link_to_delete_flag, $add_id_column_flag, $id_column_name)
	{
		if (!$records) {
			return array();
		}

		if ($link_to_detail_flag) {
			$link_to_detail_tag = array(
				'head_str' => '<a href="' . $this->_cz->newCore('url', 'get_action')->_exec('index', 'detail') . '/',
				'tail_str' => '">' . $this->_cz->newUser('config', 'model')->getValue('link_to_detail_str', 'Detail') .  '</a>',
			);
		}
		if ($link_to_update_flag) {
			$link_to_update_tag = array(
				'head_str' => '<a href="' . $this->_cz->newCore('url', 'get_action')->_exec('index', 'update') . '/',
				'tail_str' => '">' . $this->_cz->newUser('config', 'model')->getValue('link_to_update_str', 'Update') .  '</a>',
			);
		}
		if ($link_to_delete_flag) {
			$link_to_delete_tag = array(
				'head_str' => '<a href="' . $this->_cz->newCore('url', 'get_action')->_exec('index', 'delete') . '/',
				'tail_str' => '">' . $this->_cz->newUser('config', 'model')->getValue('link_to_delete_str', 'Delete') .  '</a>',
			);
		}
		
		$data_areas_list = array();
		if ($captions) {
			$column_names = array_keys($captions);
		} else {
			$column_names = array_keys(current($records));
		}
		foreach ($records as $record) {
			$data_areas = array();
			foreach ($column_names as $column_name) {
				if ($add_id_column_flag && ($column_name == $id_column_name)) {
					continue;
				}
				$data_areas[$column_name] = $this->_cz->newCore('view', 'convert')->exec($record[$column_name]);
			}
			if ($link_to_detail_flag) {
				$data_areas['__detail__'] = $link_to_detail_tag['head_str'] . $record[$id_column_name] . $link_to_detail_tag['tail_str'];
			}
			if ($link_to_update_flag) {
				$data_areas['__update__'] = $link_to_update_tag['head_str'] . $record[$id_column_name] . $link_to_update_tag['tail_str'];
			}
			if ($link_to_delete_flag) {
				$data_areas['__delete__'] = $link_to_delete_tag['head_str'] . $record[$id_column_name] . $link_to_delete_tag['tail_str'];
			}
			$data_areas_list[] = $data_areas;
		}
		
		return $data_areas_list;
	}
	
	/**
	 * @param object $model_records
	 * 
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model_records)
	{
		$id_column_name      = $model_records->getModel()->getIdColumnName();
		$column_names        = $model_records->getColumnNames();
		$captions            = $model_records->getCaptions();
		$link_to_detail_flag = $model_records->getLinkToDetailFlag();
		$link_to_update_flag = $model_records->getLinkToUpdateFlag();
		$link_to_delete_flag = $model_records->getLinkToDeleteFlag();
		
		$format_flag        = TRUE;
		$add_id_column_flag = !in_array($id_column_name, $column_names);
		$records  = $this->_cz->newCore('model', 'get_records')->exec($model_records, $format_flag, $add_id_column_flag);
		
		if (!$caption_areas = self::_getCaptionAreas($model_records, $captions, $records, $link_to_detail_flag, $link_to_update_flag, $link_to_delete_flag, $add_id_column_flag, $id_column_name)) {
			return FALSE;
		}
		$data_areas_list = self::_getDataAreasList($model_records, $captions, $records, $link_to_detail_flag, $link_to_update_flag, $link_to_delete_flag, $add_id_column_flag, $id_column_name);
		
		return $this->_cz->newCore('html', 'get_list')->exec($caption_areas, $data_areas_list);
	}
}
?>