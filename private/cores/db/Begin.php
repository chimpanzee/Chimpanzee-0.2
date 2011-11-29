<?php
final class CZCdbBegin extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$pdo = $this->_cz->newCore('db', 'connect')->exec();
		if (!$pdo->beginTransaction()) {
			$info = $pdo->errorInfo();
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_BEGIN_TRAN, $info[2]);
		}
	}
}
?>