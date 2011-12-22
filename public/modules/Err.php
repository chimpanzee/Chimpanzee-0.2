<?php
final class CZMErr extends CZBase
{
    /**
     * @param string $msg
     *
     * @return boolean
     *
     * @author Shin Uesugi
     */
    public function save($msg)
    {
        return $this->_cz->newCore('err', 'save')->exec($msg);
    }

    /**
     * @param string $default_msg <Option>
     *
     * @return string / FALSE
     *
     * @author Shin Uesugi
     */
    public function load($default_msg = NULL)
    {
        return $this->_cz->newCore('err', 'load')->exec($default_msg);
    }

    /**
     * @author Shin Uesugi
     */
    public function free()
    {
        $this->_cz->newCore('err', 'free')->exec();
    }
}
?>