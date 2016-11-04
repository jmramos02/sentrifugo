<?php

class Default_Model_Employeesubmanagers extends Zend_Db_Table_Abstract
{
    protected $_name = "employee_submanagers";
    protected $_primary = 'id';
    
    public function getEmployeeSubManagers($userId)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $empData = $db->query("SELECT e.*, m.* FROM employee_submanagers e
                              INNER JOIN main_employees_summary m ON e.submanager_id = m.user_id WHERE e.user_id=$userId");
        $res = $empData->fetchAll();
        if (isset($res) && !empty($res))
        {
            return $res;
        }
        else
            return 'norows';
    }

    public function addSubmanagers($userId, $submanagerId)
    {
        //$this->delete('user_id=' . $userId);
        $data = [
            'user_id' => $userId,
            'submanager_id' => $submanagerId
        ];
        return $this->insert($data);
    }
    
    public function deleteSubManagers($userId)
    {
        $this->delete('user_id=' . $userId);
    }
}