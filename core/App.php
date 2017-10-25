<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/10/24
 * Time: 16:42
 */
namespace core;

class App
{
    public static $config;
    public static function run()
    {
        //定义路径常量
        self::_defineDirConst();
        //定义全局字符集
        self::_initialCharset();
        //自定php引擎行为
        self::_adaterSystem();
        //加载配置文件
        self::_loadConfig();
        //自动加载
        self::_registerAutoloader();
        //解析路由
        self::_defineRouteConst();
        //分发
        self::_dispatchRoute();

    }
    protected static function _defineDirConst()
    {
        //directory_separator, 目录分隔符
        define('DS', DIRECTORY_SEPARATOR);
        //项目开始路径
        define('ROOT', __DIR__ . DS . '..');
        define('CONFIG_PATH', ROOT . DS . 'app' . DS . 'config');
    }
    protected static function _loadConfig()
    {

    }
    protected static function _adaterSystem()
    {

    }
    protected static function _initialCharset()
    {
        header('Content-type: text/html;charset=utf-8');
    }

    /**
     * 定义路由常量
     */
    protected static function _defineRouteConst()
    {
        $p = isset($_GET['p']) ? $_GET['p'] : 'frontend';
        $c = isset($_GET['c']) ? $_GET['c'] : 'user';
        $a = isset($_GET['a']) ? $_GET['a'] : 'index';
        define('PLATFORM', $p);
        define('CONTROLLER', $c);
        define('ACTION', $a);
    }
    protected static function _registerAutoloader()
    {

    }

    /**
     * 路由分发
     */
    protected static function _dispatchRoute()
    {

    }
}