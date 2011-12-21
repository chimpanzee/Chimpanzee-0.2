<?php
final class CZCdbGetParamList extends CZBase
{
    /**
     * @param array   $values
     * @param integer $num
     * 
     * @return array
     * 
     * @author Shin Uesugi
     */
    private function _getValues($values, $num = NULL)
    {
        $add_num = $num !== NULL ? '__' . $num : '';

        $param_values = array();
        foreach ($values as $param_name => $value) {
            $param_values[':' . $param_name . $add_num] = $value;
        }

        return $param_values;
    }

    /**
     * @param array $values
     * 
     * @return array
     * 
     * @author Shin Uesugi
     */
    public function exec($values)
    {
        if (!$values) {
            return array();
        }

        $value = current($values);
        if (is_array($value) && is_integer(key($values))) {
            foreach ($values as $num => $value) {
                $list[$num] = self::_getValues($value, $num);
            }
        } else {
            $list = array(self::_getValues($values));
        }

        return $list;
    }
}
?>