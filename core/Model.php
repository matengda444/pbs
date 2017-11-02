<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/10/27
 * Time: 13:35
 */
namespace core;

use Exception;

class Model extends PDOWrapper
{
    public function __construct()
    {
        parent::__construct(App::$config['database']);
    }

    /**
     * @param null $model
     * @return model
     */
    static function model($model = null)
    {
        static $obj = array();
        //echo get_called_class();exit();
        if ($model === null) {

            $model = get_called_class();
            //$model = 'app\model\Category';
            //$model = rtrim("$model", 1);
            //echo $model;exit();
        }
        //echo $model;exit();
        if (empty($obj[$model])) {
            //echo $model;exit();
            $obj[$model] = new $model;
            //var_dump($a);
            //$obj[$model] = new $model();
            //echo $model; 本来变量model应该等于 "app\model\Category" 但是不知道为何变量值是 "app\model\Category1"
            //print_r("<pre>");
            //var_dump($obj);

            //var_dump($obj[$model]);
        }
        //return $obj[$model];
        return $obj[$model];
    }

    /**
     * 根据条件查处一行数据
     */
    public function find($where = '1 = 1')
    {
        $sql = "SELECT * FROM {$this -> getTableName()} WHERE {$where} LIMIT 1";
        return $this -> getOne($sql);
    }

    /**
     * 查询出所有数据
     */
    public function findAll($where = '1 = 1')
    {
        $sql = "SELECT * FROM {$this -> getTableName()} WHERE {$where}";
        return $this -> getAll($sql);
    }

    /**
     * 查出一行数据
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM {$this -> getTableName()} WHERE id = {$id}";
        return $this -> getOne($sql);
    }

    /**
     * 插入一行数据
     */

    public function insert($row)
    {
        $fields = '';
        $values = '';
        foreach ($row as $filedName => $filedValue) {
            $fields .= $filedName . ',';
            $values .= "'{$filedValue}',";
            //echo $fields;exit();
            //echo $fields;exit();
        }
        //echo $fields;exit();
        $fields = rtrim($fields, ',');
        //echo $fields;
        $values = rtrim($values, ',');
        //echo $values;
        $sql = "INSERT INTO `{$this -> getTableName()}`
            ({$fields})
            VALUES
            ({$values})";
        return $this -> exec($sql);
    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM `{$this -> getTableName()}` WHERE id = '$id'";
       return $this -> exec($sql);
    }

    public function updateById($id, $row)
    {
        $sets = '';
        foreach ($row as $fieldName => $fieldValue) {
            $sets .= "{$fieldName} = '{$fieldValue}' ,";
            //echo $sets;
        }
        //echo $sets;exit();
        $sets = rtrim($sets, ',');
        $sql = "UPDATE `{$this -> getTableName()}` SET
            {$sets}
            WHERE id = '{$id}'";
        //echo $sql;exit();
        return $this -> exec($sql);
    }

    public function getTableName()
    {
        throw new \Exception('具体模型必须重写 getTableName() 方法');
    }
    public function count($where = '1 = 1')
    {
        $sql = "SELECT count(*) as count FROM `{$this -> getTableName()}` WHERE {$where}";
        $row = $this -> getOne($sql);
        //var_dump($row);exit;
        return $row['count'];
    }
}