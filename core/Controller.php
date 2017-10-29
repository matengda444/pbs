<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/10/26
 * Time: 21:41
 */
namespace core;

class Controller
{
    protected function _redirect($msg, $url = '?', $time = 3)
    {
        echo "<h1>$msg</h1>";
        header("refresh: {$time}; url = {$url}");
    }
    protected function _loadHtml($file, $data = array())
    {
        extract($data);
        include ROOT . '/app/view/' . PLATFORM . '/' . $file . '.html';
    }
}