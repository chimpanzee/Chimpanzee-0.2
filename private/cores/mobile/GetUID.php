<?php
final class CZCmobileGetUID extends CZBase
{
    /**
     * @return string / FALSE
     * 
     * @author Shin Uesugi
     */
    public function exec()
    {
        $carrier_name = $this->_cz->newCore('mobile', 'get_carrier_name')->exec();

        $uid = FALSE;
        switch ($carrier_name) {
            case 'docomo':
                if (isset($_SERVER['HTTP_X_DCMGUID'])) {
                    $uid = $_SERVER['HTTP_X_DCMGUID'];
                }
                break;
            case 'au':
                if (isset($_SERVER['HTTP_X_UP_SUBNO'])) {
                    $uid = $_SERVER['HTTP_X_UP_SUBNO'];
                }
                break;
            case 'softbank':
                if (isset($_SERVER['HTTP_X_JPHONE_UID'])) {
                    $uid = $_SERVER['HTTP_X_JPHONE_UID'];
                }
                break;
        }

        return $uid;
    }
}
?>