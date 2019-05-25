<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/5/25
 * Time: 22:11
 */

class IndexController extends Controller
{
    public function indexAction() {
        // echo "admin...index";
        // 载入视图
        include CUR_VIEW_PATH . 'index.html';
    }

    public function topAction() {
        include CUR_VIEW_PATH . 'top.html';
    }

    public function menuAction() {
        include CUR_VIEW_PATH . 'menu.html';
    }

    public function dragAction() {
        include CUR_VIEW_PATH . 'drag.html';
    }

    public function mainAction() {
        $adminModel = new AdminModel('admin');//不带前缀的表名
        $admins = $adminModel->getAdmins();
        echo '<pre>';
        var_dump($admins);
        include CUR_VIEW_PATH . 'main.html';
    }
}