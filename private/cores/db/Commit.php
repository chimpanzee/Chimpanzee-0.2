<?php
final class CZCdbCommit extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$pdo = $this->_cz->newCore('db', 'connect')->exec();
		if (!$pdo->commit()) {
			$info = $pdo->errorInfo();
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_COMMIT_TRAN, $info[2]);
		}
	}
}
?>