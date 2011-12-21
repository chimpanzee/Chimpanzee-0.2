<?php
require_once 'Func.php';
class CZModel extends CZFunc
{
	// Object
	private $_model_records = array();
	private $_form          = NULL;

	private $_table_name               = '';
	private $_id_column_name           = '';
	private $_mask_condition_sentences = array();
	private $_mask_condition_values    = array();
	private $_formats                  = array();
	private $_uniques                  = array();
	private $_captions                 = array();

	private $_form_model_set_values  = array();
	private $_form_ignore_part_names = array();
	private $_form_set_values        = array();
	private $_form_unique_err_msgs   = array();


	/*
	 * #Set property
	 */

	/**
	 * @param string $table_name
	 * @param string $id_column_name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function setTable($table_name, $id_column_name)
	{
		$this->_table_name     = $table_name;
		$this->_id_column_name = $id_column_name;

		return $this;
	}

	/**
	 * @param array $condition_sentences
	 * @param array $condition_values
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function setMask($condition_sentences, $condition_values = array())
	{
		$this->_mask_condition_sentences = $condition_sentences;
		$this->_mask_condition_values    = $condition_values;

		return $this;
	}

	/**
	 * @param array $formats
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function setFormats($formats)
	{
		$this->_formats = $formats;

		return $this;
	}

	/**
	 * @param array $uniques
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function setUniques($uniques)
	{
		$this->_uniques = $uniques;

		return $this;
	}

	/**
	 * @param array $captions
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function setCaptions($captions)
	{
		$this->_captions = $captions;

		return $this;
	}

	/**
	 * @param array $values
	 * 
	 * @return object
	 *        
	 * @author Shin Uesugi
	 */
	protected function setFormModelSetValues($values)
	{
		$this->_form_model_set_values = $values;

		return $this;
	}

	/**
	 * @param array $names
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function setFormIgnorePartNames($names)
	{
		$this->_form_ignore_part_names = $names;

		return $this;
	}

	/**
	 * @param array $values
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function setFormSetValues($values)
	{
		$this->_form_set_values = $values;

		return $this;
	}

	/**
	 * @param array $msgs
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function setFormUniqueErrMsgs($msgs)
	{
		$this->_form_unique_err_msgs = $msgs;

		return $this;
	}

	/**
	 * @param object $form
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function bindForm($form)
	{
		$this->_form = $form;

		return $this;
	}


	/*
	 * #Get property
	 */

	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getTableName()
	{
		if ($this->_table_name === '') {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_SET_TABLE_NAME, '', $this->getMainClassName());
		}

		return $this->_table_name;
	}

	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getIdColumnName()
	{
		if ($this->_id_column_name === '') {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_SET_ID_COLUMN_NAME, '', $this->getMainClassName());
		}

		return $this->_id_column_name;
	}

	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getMaskConditionSentences()
	{
		return $this->_mask_condition_sentences;
	}

	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getMaskConditionValues()
	{
		return $this->_mask_condition_values;
	}

	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getFormats()
	{
		return $this->_formats;
	}

	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getUniques()
	{
		return $this->_uniques;
	}

	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getCaptions()
	{
		return $this->_captions;
	}

	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getFormModelSetValues()
	{
		return $this->_form_model_set_values;
	}

	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getFormIgnorePartNames()
	{
		return $this->_form_ignore_part_names;
	}

	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getFormSetValues()
	{
		return $this->_form_set_values;
	}

	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getFormUniqueErrMsgs()
	{
		return $this->_form_unique_err_msgs;
	}

	/**
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function getBoundForm()
	{
		return $this->_form;
	}


	/*
	 * #Format record
	 */

	/**
	 * @param array $record
	 * 
	 * @return array
	 *         
	 * @author Shin Uesugi
	 */
	public function format($record)
	{
		return $this->_cz->newCore('model', 'format')->exec($this, $record);
	}


	/*
	 * #Insert data
	 */

	/**
	 * @param array $record
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function insert($record)
	{
		return $this->_cz->newCore('model', 'insert')->exec($this, $record);
	}

	/**
	 * @param array  $form_values
	 * @param array  $add_values
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function commitInsert($form_values, $add_values = array())
	{
		return $this->_cz->newCore('model', 'commit_insert')->exec($this, $form_values, $add_values);
	}


	/*
	 * #Update data
	 */

	/**
	 * @param array $record
	 * @param array $condition_sentences
	 * @param array $condition_values
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function update($record, $condition_sentences = array(), $condition_values = array())
	{
		return $this->_cz->newCore('model', 'update')->exec($this, $record, $condition_sentences, $condition_values);
	}

	/**
	 * @param integer $id
	 * @param array   $record
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function updateById($id, $record)
	{
		return $this->_cz->newCore('model', 'update')->byId($this, $id, $record);
	}

	/**
	 * @param integer $id
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function beginUpdate($id)
	{
		return $this->_cz->newCore('model', 'begin_update')->exec($this, $id);
	}

	/**
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function isBegunUpdate()
	{
		return $this->load('update_id', FALSE) !== FALSE;
	}

	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function loadUpdateId()
	{
		if (($id = $this->load('update_id', FALSE)) === FALSE) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_BEGUN_UPDATE, '', $this->getMainClassName());
		}

		return $id;
	}

	/**
	 * @param array  $form_values
	 * @param array  $add_values
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function commitUpdate($form_values, $add_values = array())
	{
		return $this->_cz->newCore('model', 'commit_update')->exec($this, $form_values, $add_values);
	}


	/*
	 * #Delete data
	 */

	/**
	 * @param array $condition_sentences
	 * @param array $condition_values
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function delete($condition_sentences = array(), $condition_values = array())
	{
		return $this->_cz->newCore('model', 'delete')->exec($this, $condition_sentences, $condition_values);
	}

	/**
	 * @param integer $id
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function deleteById($id)
	{
		return $this->_cz->newCore('model', 'delete')->byId($this, $id);
	}

	/**
	 * @param integer $id
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function beginDelete($id)
	{
		return $this->_cz->newCore('model', 'begin_delete')->exec($this, $id);
	}

	/**
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function isBegunDelete()
	{
		return $this->load('delete_id', FALSE) !== FALSE;
	}

	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function loadDeleteId()
	{
		if (($id = $this->load('delete_id', FALSE)) === FALSE) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_BEGUN_DELETE, '', $this->getMainClassName());
		}

		return $id;
	}

	/**
	 * @param array $relation_models
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function commitDelete($relation_models = array())
	{
		return $this->_cz->newCore('model', 'commit_delete')->exec($this, $relation_models);
	}


	/*
	 * #Get record
	 */

	/**
	 * @param array   $column_names
	 * @param array   $condition_sentences
	 * @param array   $condition_values
	 * @param boolean $format_flag
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getRecord($column_names = array(), $condition_sentences = array(), $condition_values = array(), $format_flag = TRUE)
	{
		return $this->_cz->newCore('model', 'get_record')->exec($this, $column_names, $condition_sentences, $condition_values, $format_flag);
	}

	/**
	 * @param integer $id
	 * @param array   $column_names
	 * @param boolean $format_flag
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getRecordById($id, $column_names = array(), $format_flag = TRUE)
	{
		return $this->_cz->newCore('model', 'get_record')->byId($this, $id, $column_names, $format_flag);
	}


	/*
	 * #Get value
	 */

	/**
	 * @param string  $column_name
	 * @param array   $condition_sentences
	 * @param array   $condition_values
	 * @param boolean $format_flag
	 * 
	 * @return scalar / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getValue($column_name, $condition_sentences = array(), $condition_values = array(), $format_flag = TRUE)
	{
		return $this->_cz->newCore('model', 'get_value')->exec($this, $column_name, $condition_sentences, $condition_values, $format_flag);
	}

	/**
	 * @param integer $id
	 * @param string  $column_name
	 * @param boolean $format_flag
	 * 
	 * @return scalar / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getValueById($id, $column_name, $format_flag = TRUE)
	{
		return $this->_cz->newCore('model', 'get_value')->byId($this, $id, $column_name, $format_flag);
	}


	/*
	 * #Get HTML
	 */

	/**
	 * @param integer $id
	 * 
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getDetailHtml($id)
	{
		return $this->_cz->newCore('model', 'get_detail_html')->exec($this, $id);
	}


	/*
	 * #Records
	 */

	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function _addRecords($name = 'default')
	{
		if (isset($this->_model_records[$name])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_ADDED_RECORDS, $name, $this->getMainClassName());
		}
		require_once 'ModelRecords.php';
		$this->_model_records[$name] = new CZModelRecords($this);
		$this->_model_records[$name]->_setCZ($this->_cz);

		return $this->_model_records[$name];
	}

	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function _getRecords($name = 'default')
	{
		if (!isset($this->_model_records[$name])) {
			if ($name == '_auto') {
				self::_addRecords('_auto');
			} else {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_ADDED_RECORDS, $name, $this->getMainClassName());
			}
		}

		return $this->_model_records[$name];
	}

	/**
	 * @param array $column_names
	 * @param array $condition_sentences
	 * @param array $condition_values
	 * @param array $options
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getRecords($column_names = array(), $condition_sentences = array(), $condition_values = array(), $options = array())
	{
		return self::_getRecords('_auto')
			->setColumnNames($column_names)
			->setCondition($condition_sentences, $condition_values)
			->_setOptions($options)
			->get();
	}

	/**
	 * @param string $id_column_name
	 * @param string $value_column_name
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * @param array  $options
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getTable($id_column_name, $value_column_name, $condition_sentences = array(), $condition_values = array(), $options = array())
	{
		$column_names = array(
			$id_column_name,
			$value_column_name,
		);

		return self::_getRecords('_auto')
			->setColumnNames($column_names)
			->setCondition($condition_sentences, $condition_values)
			->_setOptions($options)
			->getTable($id_column_name, $value_column_name);
	}
}
?>