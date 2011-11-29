<?php
final class CZModelRecords extends CZBase
{
	// Object
	private $_model;

	private $_column_names               = array();
	private $_condition_sentences        = array();
	private $_condition_values           = array();
	private $_options                    = array();
	private $_captions                   = array();
	private $_link_to_detail_flag        = FALSE;
	private $_link_to_update_flag        = FALSE;
	private $_link_to_delete_flag        = FALSE;
	private $_search_condition_sentences = array();
	private $_search_condition_values    = array();
	private $_paging                     = array();
	

	/*
	 * #Initialization
	 */
	
	/**
	 * @param object $model
	 * 
	 * @author Shin Uesugi
	 */
	function __construct($model)
	{
		$this->_model = $model;
	}
	
	
	/*
	 * #Set property
	 */
	
	/**
	 * @param array $names
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function setColumnNames($names)
	{
		$this->_column_names = $names;
		
		return $this;
	}
	
	/**
	 * @param array $sentences
	 * @param array $values
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function setCondition($sentences, $values = array())
	{
		$this->_condition_sentences = $sentences;
		$this->_condition_values    = $values;
		
		return $this;
	}
	
	/**
	 * @param array $options
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function _setOptions($options)
	{
		$this->_options = $options;
		
		return $this;
	}
	
	/**
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function enableDistinct()
	{
		$this->_options['distinct_flag'] = TRUE;
		
		return $this;
	}
	
	/**
	 * @param array $names
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function setGroupColumnNames($names)
	{
		$this->_options['group_column_names'] = $names;
		
		return $this;
	}
	
	/**
	 * @param array $sentences
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function setOrderSentences($sentences)
	{
		$this->_options['order_sentences'] = $sentences;
		
		return $this;
	}
	
	/**
	 * @param integer $limit
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function setLimit($limit)
	{
		$this->_options['limit'] = $limit;
		
		return $this;
	}
	
	/**
	 * @param integer $offset
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function setOffset($offset)
	{
		$this->_options['offset'] = $offset;
		
		return $this;
	}
	
	/**
	 * @param array $captions
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function setCaptions($captions)
	{
		$this->_captions = $captions;
		
		return $this;
	}
	
	/**
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function enableLinkToDetail()
	{
		$this->_link_to_detail_flag = TRUE;
		
		return $this;
	}
	
	/**
	 * @author Shin Uesugi
	 * 
	 * @return object
	 */
	public function enableLinkToUpdate()
	{
		$this->_link_to_update_flag = TRUE;
		
		return $this;
	}
	
	/**
	 * @author Shin Uesugi
	 * 
	 * @return object
	 */
	public function enableLinkToDelete()
	{
		$this->_link_to_delete_flag = TRUE;
		
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
	public function addSearch($condition_sentences, $condition_values = array())
	{
		$this->_search_condition_sentences = $condition_sentences;
		$this->_search_condition_values    = $condition_values;
		
		return $this;
	}
	
	/**
	 * @param integer $default_row_num
	 * @param string  $page_num_param_name
	 * @param string  $row_num_param_name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function enablePaging($default_row_num, $page_num_param_name = 'pn', $row_num_param_name = 'rn')
	{
		$this->_paging = array(
			'default_row_num'     => $default_row_num,
			'page_num_param_name' => $page_num_param_name,
			'row_num_param_name'  => $row_num_param_name,
		);
		
		return $this;
	}

	
	/*
	 * #Get property
	 */
	
	/**
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function getModel()
	{
		return $this->_model;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getColumnNames()
	{
		return $this->_column_names;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getConditionSentences()
	{
		return $this->_condition_sentences;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getConditionValues()
	{
		return $this->_condition_values;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function _getOptions()
	{
		return $this->_options;
	}
	
	/**
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function getDistinctFlag()
	{
		return isset($this->_options['distinct_flag']) ? $this->_options['distinct_flag'] : FALSE;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getGroupColumnNames()
	{
		return isset($this->_options['group_column_names']) ? $this->_options['group_column_names'] : array();
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getOrderSentences()
	{
		return isset($this->_options['order_sentences']) ? $this->_options['order_sentences'] : array();
	}
	
	/**
	 * @return integer / NULL
	 * 
	 * @author Shin Uesugi
	 */
	public function getLimit()
	{
		return isset($this->_options['limit']) ? $this->_options['limit'] : NULL;
	}
	
	/**
	 * @return integer / NULL
	 * 
	 * @author Shin Uesugi
	 */
	public function getOffset()
	{
		return isset($this->_options['offset']) ? $this->_options['offset'] : NULL;
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
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function getLinkToDetailFlag()
	{
		return $this->_link_to_detail_flag;
	}
	
	/**
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function getLinkToUpdateFlag()
	{
		return $this->_link_to_update_flag;
	}
	
	/**
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function getLinkToDeleteFlag()
	{
		return $this->_link_to_delete_flag;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getSearchConditionSentences()
	{
		return $this->_search_condition_sentences;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getSearchConditionValues()
	{
		return $this->_search_condition_values;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getPaging()
	{
		return $this->_paging;
	}
	
	
	/*
	 * #Get data
	 */
	
	/**
	 * @param boolean $format_flag
	 * 
	 * @return array
	 * 
	 * @author Shin Uesuhi
	 */
	public function get($format_flag = TRUE)
	{
		return $this->_cz->newCore('model', 'get_records')->exec($this, $format_flag);
	}
	

	/*
	 * #Get table
	 */
	
	/**
	 * @param string  $id_column_name
	 * @param string  $value_column_name
	 * @param boolean $format_flag
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getTable($id_column_name, $value_column_name, $format_flag = TRUE)
	{
		return $this->_cz->newCore('model', 'get_table')->exec($this, $id_column_name, $value_column_name, $format_flag);
	}
	
	
	/*
	 * #Get HTML
	 */

	/**
	 * @return string / FALSE
	 * 
	 * @author Shin Uesuhi
	 */
	public function getListHtml()
	{
		return $this->_cz->newCore('model', 'get_list_html')->exec($this);
	}
	
	
	/*
	 * #Get URL
	 */

	/**
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesuhi
	 */
	public function getPrevPageUrl()
	{
		return $this->_cz->newCore('model', 'get_prev_page_url')->exec($this);
	}

	/**
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesuhi
	 */
	public function getNextPageUrl()
	{
		return $this->_cz->newCore('model', 'get_next_page_url')->exec($this);
	}
}
?>