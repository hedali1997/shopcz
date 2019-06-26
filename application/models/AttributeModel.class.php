<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/6/24
 * Time: 23:13
 */
// 商品属性模型
class AttributeModel extends Model {
    // 获取指定类型下的所有属性
    public function getAttrs($type_id) {
        $type_table = $GLOBALS['config']['prefix'] . 'goods_type';
        if ($type_id == 0) {
            $sql = "SELECT * FROM {$this->table} as a INNER JOIN $type_table as b ON a.type_id = b.type_id";
        } else {
            $sql = "SELECT * FROM {$this->table} as a INNER JOIN $type_table as b ON a.type_id = b.type_id WHERE a.type_id = $type_id";
        }
        return $this->db->getAll($sql);
    }
    // 获取指定类型下的所有属性
    public function getPageAttrs($type_id, $offset, $limit) {
        $type_table = $GLOBALS['config']['prefix'] . "goods_type";
        if ($type_id == 0) {
            $sql = "SELECT * FROM {$this->table} as a INNER JOIN $type_table as b ON a.type_id = b.type_id ORDER BY attr_id DESC LIMIT $offset,$limit";
        } else {
            $sql = "SELECT * FROM {$this->table} as a INNER JOIN $type_table as b ON a.type_id = b.type_id WHERE a.type_id = $type_id ORDER BY attr_id DESC LIMIT $offset,$limit";
        }
        return $this->db->getAll($sql);
    }

}