<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/6/16
 * Time: 12:25
 */
// 批量实体转义
function deepspecialchars($data) {
    if (empty($data)) {
        return $data;
    }
//    普通写法
/*    if (is_array($data)) {
        // 数组 array('cat_id'=>1,'cat_name'=>'服装')
        foreach ($data as $k => $v) {
            $data[$k] = deepspecialchars($v);
        }
        return $data;
    } else {
        // 单个变量
        return htmlspecialchars($data);
    }*/

//    高级写法
    return is_array($data) ? array_map('deepspecialchars', $data) : htmlspecialchars($data);
}