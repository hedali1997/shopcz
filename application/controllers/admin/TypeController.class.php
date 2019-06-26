<?php
/**
 * Created by PhpStorm.
 * User: hdl
 * Date: 2019/6/24
 * Time: 21:34
 */
// 后台商品类型管理
class TypeController extends BaseController {
    // 显示类型
    public function indexAction() {
        //获取所有的商品类型
        $typeModel = new TypeModel('goods_type');
        // $types = $typeModel->getTypes();
        // 分页获取数据
        $pagesize = 2;
        $current = isset($_GET['page']) ? $_GET['page'] : 1;//当前所在页数
        $offset = ($current - 1) * $pagesize;
        $types = $typeModel->getPageTypes($offset, $pagesize);
        //显示分页详情
        $this->library('Page');
        //获取总的记录数
        $where = "";
        $total = $typeModel->total($where);
        $page = new Page($total, $pagesize, $current, 'index.php', array('p' => 'admin', 'c' => 'type', 'a' => 'index'));
        $pageinfo = $page->showPage();
        // 载入视图
        include CUR_VIEW_PATH . "goods_type_list.html";
    }
    // 显示添加类型页面
    public function addAction() {
        include CUR_VIEW_PATH . "goods_type_add.html";
    }
    // 类型入库操作
    public function insertAction() {
        // 1.手机表单数组，以关联数组的形式
        $data['type_name'] = trim($_POST['type_name']);
        // 2.验证和处理
        if ($data['type_name'] === '') {
            $this->jump('index.php?pa=admin&c=type&a=add', '商品类型名称不能为空');
        }
        // 进行转义处理
        $this->helper('input');
        $data = deepspecialchars($data);
        $data = deepslashes($data);
        // 3.调用模型完成入库操作并给出提示
        $typeModel = new TypeModel('goods_type');
        if ($typeModel->insert($data)) {
            $this->jump('index.php?p=admin&c=type&a=index', '添加商品类型成功', 1);
        } else {
            $this->jump('index.php?p=admin&c=type&a=add', '添加商品类型失败');
        }
    }
}