<?php
final class CZCdbConnect extends CZBase
{
	/**
	 * @param boolean $select_flag
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	private function _getServer($select_flag)
	{
		$servers = $this->_cz->newUser('config', 'db')->getValue('servers');
		if ($select_flag && isset($servers['sub'])) {
			$sub_num = is_array($servers['sub']) ? count($servers['sub']) : 0;
			if (!$sub_num) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_NOT_SET_SERVER_SUB);
			}
			$server = $servers['sub'][rand(0, $sub_num - 1)];
			$main_flag = FALSE;
		} else {
			if (!isset($servers['main'])) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_NOT_SET_SERVER_MAIN);
			}
			$server = $servers['main'];
			$main_flag = TRUE;
		}
		
		return array($server, $main_flag);
	}
	
	/**
	 * @param boolean $select_flag
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($select_flag = FALSE)
	{
		$pdo_tran = $this->_cz->loadStatic('db')->getPDOTran();
		if ($pdo_tran) {
			return $pdo_tran;
		}
		
		$pdo_select = $this->_cz->loadStatic('db')->getPDOSelect();
		if ($pdo_select) {
			if ($select_flag) {
				return $pdo_select;
			}
			$pdo_select = NULL;
			$this->_cz->loadStatic('db')->setPDOSelect(NULL);
		}
		
		list($server, $tran_flag) = self::_getServer($select_flag);
		if (!isset($server['dsn'])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_NOT_SET_SERVER_DSN);
		}
		if (!isset($server['user'])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_NOT_SET_SERVER_USER);
		}
		if (!isset($server['pass'])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_NOT_SET_SERVER_PASS);
		}
		$persistent_flag = $this->_cz->newUser('config', 'db')->getValue('persistent_flag', FALSE);
		$options = array(PDO::ATTR_PERSISTENT => $persistent_flag);
		try {
			if ($tran_flag) {
				$pdo = new PDO($server['dsn'], $server['user'], $server['pass'], $options);
				$this->_cz->loadStatic('db')->setPDOTran($pdo);
			} else {
				$pdo = new PDO($server['dsn'], $server['user'], $server['pass'], $options);
				$this->_cz->loadStatic('db')->setPDOSelect($pdo);
			}
		} catch (PDOException $e) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_CONNECT_SERVER, $e->getMessage());
		}
		
		switch ($driver_name = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME)) {
			case 'mysql':
				$this->_cz->newCore('db', 'request')->exec('SET NAMES utf8');
				break;
/*
			default:
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_NOT_SUPPORT_DRIVER, $driver_name);
*/
		}
		
		return $pdo;
	}
}
?>