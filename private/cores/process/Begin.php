<?php
final class CZCprocessBegin extends CZBase
{
    /**
     * @param string $process_name <Option>
     * 
     * @author Shin Uesugi
     */
    public function exec($process_name = NULL)
    {
        if ($process_name === NULL) {
            $process_name = $this->_cz->newCore('process', 'get_default_name')->exec();
        }

        $this->_cz->newCore('ses', 'set')->exec('process_name', $process_name);
    }
}
?>