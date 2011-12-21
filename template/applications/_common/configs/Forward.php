<?php
final class configForward extends CZConfig
{
    public function _construct()
    {
        $this->setValues(array(
            'return_flag' => FALSE,
        ));
    }
}
?>