<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/6/12
 * Time: 21:17
 */
// 后台商品分类管理
class CategoryController extends BaseController
{
    // 显示分类
    public function indexAction() {
        // 获取所有的分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->getCats();
        // 载入视图
        include CUR_VIEW_PATH . "cat_list.html";
    }
    // 显示添加分类页面
    public function addAction() {
        // 获取所有的分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->getCats();
        // 载入视图
        include CUR_VIEW_PATH . "cat_add.html";
    }
    // 分类入库操作
    public function insertAction() {
        //1.收集表单数据，以关联数组的形式来收集 Ctrl+D 复制一行
        $data['cat_name'] = trim($_POST['cat_name']);
        $data['parent_id'] = $_POST['parent_id'];// 多点编辑 Alt+J
        $data['unit'] = trim($_POST['unit']);
        $data['sort_order'] = trim($_POST['sort_order']);
        $data['cat_desc'] = trim($_POST['cat_desc']);
        $data['is_show'] = $_POST['is_show'];
        //2.验证和处理
        if ($data['cat_name'] === '') {
            $this->jump('index.php?p=admin&c=category&a=add', '分类名称不能为空');
        }
        //3.调用模型完成入库操作并给出指示
        $categoryModel = new CategoryModel('category');
        if ($categoryModel->insert($data)) {
            $this->jump('index.php?p=admin&c=category&a=index', '添加分类成功');
        } else {
            $this->jump('index.php?p=admin&c=category&a=add', '添加分类失败');
        }
    }
    // 显示编辑分类页面
    public function editAction() {
        // 获取cat_id
        $cat_id = $_GET['cat_id'] + 0;//隐式转换成整型确保安全
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->getCats();
        $cat = $categoryModel->selectByPk($cat_id);

        include CUR_VIEW_PATH . "cat_edit.html";
    }
    // 分类更新操作
    public function updateAction() {
        $data['cat_name'] = trim($_POST['cat_name']);
        $data['parent_id'] = $_POST['parent_id'];
        $data['unit'] = trim($_POST['unit']);
        $data['sort_order'] = trim($_POST['sort_order']);
        $data['cat_desc'] = trim($_POST['cat_desc']);
        $data['is_show'] = $_POST['is_show'];
        $data['cat_id'] = $_POST['cat_id'];

        // 实体转义
        // 引入辅助函数
        $this->helper('input');
        $data = deepspecialchars($data);

        if ($data['cat_name'] === '') {
            $this->jump('index.php?p=admin&c=category&a=add', '分类名称不能为空');
        }
        // 调用模型完成更新后输出提示
        $categoryModel = new CategoryModel('category');
        // 在更新之前，做一个判断，不得将当前分类的后代分类作为其上级分类
        $ids = $categoryModel->getSubIds($data['cat_id']);
        if (in_array($data['parent_id'], $ids)) {
            $this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}", '不能将当前分类或当前分类的后代作为其上级分类');
        }
        if ($categoryModel->update($data)) {
            $this->jump('index.php?p=admin&c=category&a=index', '修改分类成功', 1);
        } else {
            $this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}", '修改分类失败');
        }
    }
    // 删除分类操作
    public function deleteAction() {
        $cat_id = $_GET['cat_id'] + 0;

        $categoryModel = new CategoryModel('category');
        // 判断当前分类是否还有后代分类
        $ids = $categoryModel->getSubIds($cat_id);
        if (count($ids) > 1) {
            $this->jump('index.php?p=admin&c=category&a=index', '当前分类有后代分类，不允许删除');
        }
        if ($categoryModel->delete($cat_id)) {
            $this->jump('index.php?p=admin&c=category&a=index', '删除分类成功', 1);
        } else {
            $this->jump('index.php?p=admin&c=category&a=index', '删除分类失败');
        }
    }
}