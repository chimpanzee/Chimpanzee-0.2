<?php
final class CZCredirectRoot extends CZBase
{
    /**
     * @param boolean $secure_flag <Option>
     * @param array   $params(
     *            'routing' => array(
     *                string Parameter value
     *                ...
     *            ) <Option>
     *            'get' => array(
     *                string Parameter name => string Parameter value
     *                ...
     *            ) <Option>
     *        ) <Option>
     *
     * @return Exit
     *
     * @author Shin Uesugi
     */
    public function exec($secure_flag = NULL, $params = NULL)
    {
        $url = $this->_cz->newCore('url', 'get_root')->exec($secure_flag, $params);
        $this->_cz->newCore('redirect', 'url')->exec($url);
    }
}
?>