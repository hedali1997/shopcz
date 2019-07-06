<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/6/29
 * Time: 9:46
 */
// 前台首页控制器
class IndexController extends Controller {
    // 显示首页
    public function indexAction() {
        // 获取所有的分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->frontCats();
        include CUR_VIEW_PATH . "index.html";
    }
}