<?php
final class CZCroutingGetActionName extends CZBase
{
    /**
     * @return string
     * 
     * @author Shin Uesugi
     */
    public function exec()
    {
        $parts = $this->_cz->newCore('routing', 'get_parts')->exec();

        return $parts['action_name'];
    }
}
?>