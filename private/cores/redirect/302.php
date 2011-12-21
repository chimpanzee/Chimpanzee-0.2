<?php
final class CZCredirect302 extends CZBase
{
    /**
     * @param string $url
     * 
     * @return Exit
     * 
     * @author Shin Uesugi
     */
    public function exec($url)
    {
        $this->_cz->newCore('redirect', 'url')->exec($url, 302);
    }
}
?>