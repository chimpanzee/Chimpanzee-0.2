<?php
final class CZCloginSaveSrcUrl extends CZBase
{
    /**
     * @param string $url
     *
     * @author Shin Uesugi
     */
    public function exec($url)
    {
        $this->_cz->newCore('ses', 'set')->exec('auto_redirect_src_url', $url);
    }
}
?>