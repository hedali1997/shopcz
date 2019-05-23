<?php
/**
 * @Author: 贺大礼
 * @Date:   2019-05-23 21:31:41
 * @Last Modified by:   Marte
 * @Last Modified time: 2019-05-23 21:38:06
 */

/**
* 核心启动类
*/
class Framework
{
    function __construct()
    {

    }

    // run方法
    public static function run() {
        // echo "hello world!";
        self::init();
        self::autoload();
        self::dispatch();
    }

    // 初始化方法
    private static function init() {

    }
}
