<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/5/25
 * Time: 22:50
 */
// 核心控制器
class Controller {
    // 提示信息并跳转
    public function jump($url, $message, $wait = 3) {
        if ($wait == 0) {
            header('Location:$url');
        } else {
            include CUR_VIEW_PATH . 'message.html';
        }
        // 一定要退出
        exit;
    }
}