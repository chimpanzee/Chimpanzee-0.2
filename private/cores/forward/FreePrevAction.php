<?php
final class CZCforwardFreePrevAction extends CZBase
{
    /**
     * @author Shin Uesugi
     */
    public function exec()
    {
        if ($this->_cz->newCore('ses', 'is_valid')->exec()) {
            $this->_cz->newCore('ses', 'free')->exec('prev_ctrl_name');
            $this->_cz->newCore('ses', 'free')->exec('prev_action_group_name');
            $this->_cz->newCore('ses', 'free')->exec('prev_action_name');
        }
    }
}
?>