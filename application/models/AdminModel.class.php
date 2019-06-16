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
    public function checkUser($username, $password) {
        $password = md5($password);
        $sql = "select * from {$this->table} where admin_name = '$username' and password = '$password' limit 1";
        return $this->db->getRow($sql);// 返回一维数据
    }
}