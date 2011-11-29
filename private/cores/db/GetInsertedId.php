<?php
final class CZCdbGetInsertedId extends CZBase
{
	/**
	 * @param string $sequence_name
	 * 
	 * @return PDO::lastInsertId
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($sequence_name = NULL)
	{
		$pdo = $this->_cz->newCore('db', 'connect')->exec();
		
		return $pdo->lastInsertId($sequence_name);
	}
}
?>