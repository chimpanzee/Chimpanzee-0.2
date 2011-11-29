<?php
require_once 'Func.php';
class CZForm extends CZFunc
{
	private $_parts = array();
	
	
	/*
	 * #Set property
	 */
	
	/**
	 * @param array $parts
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function setParts($parts)
	{
		$this->_parts = $parts;
		
		return $this;
	}
	
	/**
	 * @param string $part_name
	 * @param array  $part
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function addPart($part_name, $part)
	{
		if (isset($this->_parts[$part_name])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_SET_PART, $part_name, $this->getMainClassName());
		}
		$this->_parts[$part_name] = $part;
		
		return $this;
	}
	
	/**
	 * @param string $part_name
	 * @param string $property_name
	 * @param mixed  $value
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function addPartProperty($part_name, $property_name, $value)
	{
		if (!isset($this->_parts[$part_name])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_NOT_SET_PART, $part_name, $this->getMainClassName());
		}
		if (isset($this->_parts[$part_name][$property_name])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_SET_PART_PROPERTY, $part_name, $this->getMainClassName());
		}
		$this->_parts[$part_name][$property_name] = $value;
		
		return $this;
	}
	
	
	/*
	 * #Get property
	 */
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getParts()
	{
		if (!$this->_parts) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_NOT_SET_PARTS, '', $this->getMainClassName());
		}
		
		return $this->_parts;
	}
	
	
	/*
	 * #Value
	 */
	
	/**
	 * @param array $replace_values
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function initValues($replace_values = array())
	{
		return $this->_cz->newCore('form', 'init_values')->exec($this, $replace_values);
	}
	
	/**
	 * @param array $values
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function saveValues($values)
	{
		return $this->_cz->newCore('form', 'save_values')->exec($this, $values);
	}
	
	/**
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function saveValuesByPost()
	{
		return $this->_cz->newCore('form', 'save_values')->byPost($this);
	}
	
	/**
	 * @param array $default_values
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function loadValues($default_values = array())
	{
		if (!($values = $this->load('values', array()))) {
			if ($default_values !== array()) {
				return $default_values;
			}
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_NOT_SAVED_VALUES, $var_name, $main_class_name);
		}
		
		return $values;
	}

	
	/*
	 * #Save error
	 */
	
	/**
	 * @param string $part_name
	 * @param string $msg
	 * 
	 * @author Shin Uesugi
	 */
	public function saveErr($part_name, $msg)
	{
		$this->_cz->newCore('form', 'save_err')->exec($this, $part_name, $msg);
	}
	
	
	/*
	 * #Get form HTML
	 */
	
	/**
	 * @param string $part_name
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getEditTag($part_name)
	{
		return $this->_cz->newCore('form', 'get_edit_tag')->exec($this, $part_name);
	}
	
	/**
	 * @param string $part_name
	 * 
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getErr($part_name)
	{
		return $this->_cz->newCore('form', 'get_err')->exec($this, $part_name);
	}
	
	/**
	 * @param string $part_name
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getFormDataArea($part_name)
	{
		return $this->_cz->newCore('form', 'get_form_data_area')->exec($this, $part_name);
	}
	
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getFormHtml()
	{
		return $this->_cz->newCore('form', 'get_form_html')->exec($this);
	}
	
	
	/*
	 * #Get confirm HTML
	 */
	
	/**
	 * @param string  $part_name
	 * @param boolean $escape_flag
	 * 
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getConfirmDataArea($part_name, $escape_flag = TRUE)
	{
		return $this->_cz->newCore('form', 'get_confirm_data_area')->exec($this, $part_name, $escape_flag);
	}
	
	/**
	 * @param $escape_flag
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getConfirmHtml($escape_flag = TRUE)
	{
		return $this->_cz->newCore('form', 'get_confirm_html')->exec($this, $escape_flag);
	}
	
	
	/*
	 * #Load uploaded files
	 */
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function loadUploadedFiles()
	{
		return $this->load('uploaded_files', array());
	}
}
?>