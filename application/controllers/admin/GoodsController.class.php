<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/6/26
 * Time: 18:29
 */
class GoodsController extends BaseController
{
    // 显示商品
    public function indexAction() {
        include CUR_VIEW_PATH . 'goods_list.html';
    }
    //显示添加商品页面
    public function addAction() {
        // 获取所有的商品分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->getCats();
        // 获取所有的品牌
        $brandModel = new BrandModel('brand');
        $brands = $brandModel->getBrands();
        //获取所有的商品类型
        $typeModel = new TypeModel('goods_type');
        $types = $typeModel->getTypes();
        // 载入视图界面
        include CUR_VIEW_PATH . 'goods_add.html';
    }
}