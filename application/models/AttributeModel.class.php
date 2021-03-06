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

    //获取指定类型下的所有属性并形成表格
    public function getAttrsTable($type_id) {
        $sql = "SELECT * FROM {$this->table} WHERE type_id = $type_id";
        $attrs = $this->db->getAll($sql);//结果是二维数组
        $res = "<table width='100%' id='attrTable'>";
        foreach($attrs as $attr) {
            $res .= "<tr>";
            $res .= "<td class='label'>{$attr['attr_name']}</td>";
            $res .= "<td>";
            $res .= "<input type='hidden' name='attr_id_list[]' value='{$attr['attr_id']}'>";
            switch ($attr['attr_input_type']) {
                case 0: #文本框
                    $res .= "<input name='attr_value_list[]' type='text'  size='40'>";
                    break;
                case 1: #下拉列表
                    $res .= "<select name='attr_value_list[]'>";
                    $res .= "<option value=''>请选择。。。</option>";
                    $opts = explode(PHP_EOL, $attr['attr_value']);
                    foreach ($opts as $opt) {
                        $res .= "<option value='$opt'>$opt</option>";
                    }
                    $res .= "</select>";
                    break;
                case 2: #多行文本
                    $res .= "<textarea name='attr_value_list[]' cols='30' rows='10'></textarea>";
                    break;
            }
            $res .= "<input type='hidden' name='attr_price_list[]' value='0'>";
            $res .= "</td>";
            $res .= "</tr>";
        }
        $res .= "</table>";
        return $res;
    }

}