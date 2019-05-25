<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/5/25
 * Time: 23:23
 */

class AdminModel extends Model
{
    public function getAdmins() {
        $sql = "select * from cz_admin";
        return $this->db->getAll($sql);
    }
}