<?php
final class CZCredirectAction extends CZBase
{
    /**
     * @param array $action(
     *            string Action name
     *            string Action group name <Option>
     *            string Controller name   <Option>
     *        )
     * @param boolean $secure_flag <Option>
     * @param array $params(
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
    public function _exec($action, $secure_flag = NULL, $params = NULL)
    {
        $url = $this->_cz->newCore('url', 'get_action')->_exec($action, $secure_flag, $params);
        $this->_cz->newCore('redirect', 'url')->exec($url);
    }

    /**
     * @param array $action(
     *            string Action name
     *            string Controller name <Option>
     *        )
     * @param boolean $secure_flag <Option>
     * @param array $params(
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
    public function exec($action, $secure_flag = NULL, $params = NULL)
    {
        if (isset($action[1])) {
            $action[2] = $action[1];
            $action[1] = NULL;
        }
        self::_exec($action, $secure_flag, $params);
    }
}
?>