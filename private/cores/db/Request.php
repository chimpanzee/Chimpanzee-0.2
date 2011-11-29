<?php
final class CZCdbRequest extends CZBase
{
	/**
	 * @param string $query
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($query)
	{
		$pdo = $this->_cz->newCore('db', 'connect')->exec();
		if (($record_num = $pdo->exec($query)) === FALSE) {
			$info = $pdo->errorInfo();
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_EXEC_QUERY, $info[2] . '[' . $query . ']');
		}
		
		return $record_num;
	}
}
?>