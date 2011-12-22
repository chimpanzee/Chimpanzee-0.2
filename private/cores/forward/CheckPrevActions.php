<?php
final class CZCforwardCheckPrevActions extends CZBase
{
    /**
     * @param array $actions(
     *            array(
     *                string Action name
     *                string Action group name <Option>
     *                string Controller name   <Option>
     *            )
     *            ...
     *        )
     *
     * @return Void / Forward 403
     *
     * @author Shin Uesugi
     */
    public function _exec($actions)
    {
        $current_ctrl_name         = $this->_cz->loadStatic('forward')->getCtrlName();
        $current_action_group_name = $this->_cz->loadStatic('forward')->getActionGroupName();
        $current_action_name       = $this->_cz->loadStatic('forward')->getActionName();

        $prev_ctrl_name         = $this->_cz->loadStatic('forward')->getPrevCtrlName();
        $prev_action_group_name = $this->_cz->loadStatic('forward')->getPrevActionGroupName();
        $prev_action_name       = $this->_cz->loadStatic('forward')->getPrevActionName();

        if (($current_ctrl_name === $prev_ctrl_name) && ($current_action_group_name === $prev_action_group_name) && ($current_action_name === $prev_action_name)) {
            return;
        }

        $hit_flag = FALSE;
        foreach ($actions as $action) {
            if (isset($action[2])) {
                $ctrl_name = $action[2];
            } else {
                $ctrl_name = $current_ctrl_name;
            }
            if (isset($action[1])) {
                $action_group_name = $action[1];
            } else {
                if (isset($action[2])) {
                    $action_group_name = NULL;
                } else {
                    $action_group_name = $current_action_group_name;
                }
            }
            if (isset($action[0])) {
                $action_name = $action[0];
            } else {
                $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_COMMON_NOT_EXIST_ACTION_NAME);
            }

            if (($ctrl_name === $prev_ctrl_name) && ($action_group_name === $prev_action_group_name) && ($action_name === $prev_action_name)) {
                $hit_flag = TRUE;
                break;
            }
        }

        if (!$hit_flag) {
            $this->_cz->newCore('forward', '403')->exec();
        }
    }

    /**
     * @param array $actions(
     *            array(
     *                string Action name
     *                string Controller name <Option>
     *            )
     *            ...
     *        )
     *
     * @return Void / Forward 403
     *
     * @author Shin Uesugi
     */
    public function exec($actions)
    {
        foreach ($actions as $key => $action) {
            if (isset($action[1])) {
                $actions[$key][2] = $action[1];
                $actions[$key][1] = NULL;
            }
        }
        self::_exec($actions);
    }
}
?>