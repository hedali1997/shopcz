<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/6/24
 * Time: 21:48
 */
// 商品类型模型
class TypeModel extends Model {
    // 获取所有的商品类型
    public function getTypes() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->getAll($sql);
    }
    //分页获取商品类型
    public function getPageTypes($offset, $limit) {
        $sql = "SELECT * FROM {$this->table}
                ORDER BY type_id DESC
                LIMIT $offset,$limit";
        return $this->db->getAll($sql);
    }
}