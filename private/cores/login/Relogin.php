<?php
final class CZCloginRelogin extends CZBase
{
    /**
     * @param object $model
     * 
     * @return boolean
     * 
     * @author Shin Uesugi
     */
    public function exec($model)
    {
        if (($login_id = $this->_cz->newCore('login', 'get_id')->exec()) === FALSE) {
            return FALSE;
        }

        $this->_cz->newCore('login', 'logout')->exec();

        $id_column_name = $model->getIdColumnName();

        $values = array(
            $id_column_name => $login_id,
        );
        $auth_column_names = array(
            $id_column_name,
        );

        return $this->_cz->newCore('login', 'login')->exec($model, $values, $auth_column_names);
    }
}
?>