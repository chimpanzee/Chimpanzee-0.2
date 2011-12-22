<?php
final class CZCdbRequestPrepare extends CZBase
{
    /**
     * @param string  $query
     * @param array   $param_list
     * @param boolean $select_flag
     *
     * @return object
     *
     * @author Shin Uesugi
     */
    public function exec($query, $param_list, $select_flag = FALSE)
    {
        $pdo = $this->_cz->newCore('db', 'connect')->exec($select_flag);
        try {
            if (!($pdo_stmt = $pdo->prepare($query))) {
                $info = $pdo->errorInfo();
                $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_PREPARE_QUERY, $info[2] . '[' . $query . ']');
            }
        } catch (PDOException $e) {
            $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_PREPARE_QUERY, $e->getMessage() . '[' . $query . ']');
        }

        foreach ($param_list as $param_values) {
            foreach ($param_values as $colon_param_name => $value) {
                if (is_array($value)) {
                    continue;
                }
                if ($value === '') {
                    $value = NULL;
                }

                if ($value === NULL) {
                    $data_type = PDO::PARAM_NULL;
                } else if (is_bool($value)) {
                    $value = $value ? 1 : 0;
                    $data_type = PDO::PARAM_BOOL;
                } else if (is_integer($value)) {
                    $data_type = PDO::PARAM_INT;
                } else {
                    $data_type = PDO::PARAM_STR;
                }

                if (!$pdo_stmt->bindValue($colon_param_name, $value, $data_type)) {
                    $info = $pdo_stmt->errorInfo();
                    $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_BIND_VALUE, $info[2] . '[' . $query . ']');
                }
            }
        }

        if (!$pdo_stmt->execute()) {
            $info = $pdo_stmt->errorInfo();
            $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_EXEC_QUERY, $info[2] . '[' . $query . ']');
        }

        return $pdo_stmt;
    }
}
?>