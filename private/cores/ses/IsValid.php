<?php
final class CZCsesIsValid extends CZBase
{
    /**
     * @return boolean
     * 
     * @author Shin Uesugi
     */
    public function exec()
    {
        if ($this->_cz->newUser('config', 'ses')->getValue('secure_flag', TRUE)) {
            if (!$this->_cz->newCore('url', 'is_secure')->exec()) {
                return FALSE;
            }
        }

        return TRUE;
    }
}
?>