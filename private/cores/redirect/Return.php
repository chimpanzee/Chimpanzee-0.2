<?php
final class CZCredirectReturn extends CZBase
{
    /**
     * @param array   $default_action <Option>
     *        array(
     *            string Controller name
     *            string Action group name <Option>
     *            string Action name <Option>
     *        )
     * @param boolean $secure_flag <Option>
     * @param array   $params <Option>
     *        array(
     *            'routing' => array(
     *                string Parameter value
     *                ...
     *            ) <Option>
     *            'get' => array(
     *                string Parameter name => string Parameter value
     *                ...
     *            ) <Option>
     *        )
     * 
     * @return Exit / FALSE
     * 
     * @author Shin Uesugi
     */
    public function _exec($default_action = NULL, $secure_flag = NULL, $params = NULL)
    {
        if (!($url = $this->_cz->newCore('url', 'get_return')->exec())) {
            if ($default_action === NULL) {
                return FALSE;
            }

            $this->_cz->newCore('redirect', 'action')->_exec($default_action, $secure_flag, $params);
        }

        $this->_cz->newCore('redirect', 'url')->exec($url);
    }

    /**
     * @param array   $default_action <Option>
     *        array(
     *            string Controller name
     *            string Action name <Option>
     *        )
     * @param boolean $secure_flag <Option>
     * @param array   $params <Option>
     *        array(
     *            'routing' => array(
     *                string Parameter value
     *                ...
     *            ) <Option>
     *            'get' => array(
     *                string Parameter name => string Parameter value
     *                ...
     *            ) <Option>
     *        )
     * 
     * @return Exit / FALSE
     * 
     * @author Shin Uesugi
     */
    public function exec($default_action = NULL, $secure_flag = NULL, $params = NULL)
    {
        if ($default_action) {
            if (isset($default_action[1])) {
                $default_action[2] = $default_action[1];
                $default_action[1] = NULL;
            }
        }

        self::_exec($action, $secure_flag, $params);
    }
}
?>