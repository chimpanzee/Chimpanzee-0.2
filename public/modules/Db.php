<?php
final class CZMDb extends CZBase
{
	/*
	 * #Transaction
	 */
	
	/**
	 * @author Shin Uesugi
	 */
	public function begin()
	{
		$this->_cz->newCore('db', 'begin')->exec();
	}
	
	/**
	 * @author Shin Uesugi
	 */
	public function commit()
	{
		$this->_cz->newCore('db', 'commit')->exec();
	}
	
	
	/*
	 * #Request query
	 */
	
	/**
	 * @param string $query
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function request($query)
	{
		return $this->_cz->newCore('db', 'request')->exec($query);
	}
	
	
	/*
	 * #Update data
	 */
	
	/**
	 * @param string $table_name
	 * @param array  $record
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function insert($table_name, $record)
	{
		return $this->_cz->newCore('db', 'insert')->exec($table_name, $record);
	}
	
	/**
	 * @return PDO::lastInsertId
	 * 
	 * @author Shin Uesugi
	 */
	public function getInsertedId()
	{
		return $this->_cz->newCore('db', 'get_inserted_id')->exec();
	}
	
	/**
	 * @param string $table_name
	 * @param array  $record
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function update($table_name, $record, $condition_sentences = array(), $condition_values = array())
	{
		return $this->_cz->newCore('db', 'update')->exec($table_name, $record, $condition_sentences, $condition_values);
	}
	
	/**
	 * @param string $table_name / array
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function delete($table_name, $condition_sentences = array(), $condition_values = array())
	{
		return $this->_cz->newCore('db', 'delete')->exec($table_name, $condition_sentences, $condition_values);
	}
	
	
	/*
	 * #Get data
	 */
	
	/**
	 * @param string $table_name
	 * @param string $column_name
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return scalar / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getValue($table_name, $column_name, $condition_sentences = array(), $condition_values = array())
	{
		return $this->_cz->newCore('db', 'get_value')->exec($table_name, $column_name, $condition_sentences, $condition_values);
	}
	
	/**
	 * @param string $table_name
	 * @param array  $column_names
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getRecord($table_name, $column_names = array(), $condition_sentences = array(), $condition_values = array())
	{
		return $this->_cz->newCore('db', 'get_record')->exec($table_name, $column_names, $condition_sentences, $condition_values);
	}
	
	/**
	 * @param string $table_name
	 * @param array  $column_names
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * @param array  $options
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getRecords($table_name, $column_names = array(), $condition_sentences = array(), $condition_values = array(), $options = array())
	{
		return $this->_cz->newCore('db', 'get_records')->exec($table_name, $column_names, $condition_sentences, $condition_values, $options);
	}
	
	
	/*
	 * #Ngram
	 */
	
	/**
	 * @param integer $n
	 * @param string  $str
	 * @param string  $prefix
	 * @param boolean $encode_flag
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getNgram($n, $str, $prefix = '', $encode_flag = FALSE)
	{
		return $this->_cz->newCore('db', 'get_ngram')->exec($n, $str, $prefix, $encode_flag);
	}
}
?>