<?php
final class CZCprocessGetDefaultName extends CZBase
{
    /**
     * @return string
     * 
     * @author Shin Uesugi
     */
    public function exec()
    {
        $ctrl_name         = $this->_cz->loadStatic('forward')->getCtrlName();
        $action_group_name = $this->_cz->loadStatic('forward')->getActionGroupName();

        $process_name = $ctrl_name;
        if ($action_group_name !== NULL) {
            $process_name .= '-' . $action_group_name;
        }

        return $process_name;
    }
}
?>