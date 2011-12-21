<?php
final class CZCloginRedirectSrcUrl extends CZBase
{
    /**
     * @author Shin Uesugi
     */
    public function exec()
    {
        if (!($src_url = $this->_cz->newCore('ses', 'get')->exec('auto_redirect_src_url', FALSE))) {
            $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_LOGIN_NOT_SAVED_SRC_URL);
        }

        $this->_cz->newCore('ses', 'free')->exec('auto_redirect_src_url');

        $this->_cz->newCore('redirect', 'url')->exec($src_url);
    }
}
?>