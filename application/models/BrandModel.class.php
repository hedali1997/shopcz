<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/6/24
 * Time: 21:48
 */
// 商品品牌模型
class BrandModel extends Model {
    // 获取所有的商品品牌
    public function getBrands() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->getAll($sql);
    }
}