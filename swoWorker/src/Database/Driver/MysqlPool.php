<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-02-05
 * Time: 21:07
 */
namespace SwoWorker\Database\Driver;
use Swoole\Database\PDOConfig;
use Swoole\Database\PDOPool;

class MysqlPool
{
    /**
     * 连接数据的地址
     * @var string
     */
//    CONST DRIVER_CLASS = 'mysql:host=127.0.0.1;dbname=test';

    protected $dbName = 'test';

    protected $host = '127.0.0.1';

    protected $port = 3306;

    protected $charset = 'utf8';

    /**
     * 数据库的用户名
     * @var string
     */
    protected $username = 'root';

    /**
     * 数据库的密码
     * @var string
     */
    protected $password = '0000';

    /**
     * 数据库连接出错
     * @var string|array
     */
    private $error = '没有异常';

    /**
     * 连接池
     * @var pool
     */
    private $pool;

    public function __construct($pool)
    {
        try {
            // 初始化执行数据库类
            $this->pool = $pool;
        } catch (PDOException  $e) {
            // throw new \Exception($e->getMessage(), 500);
            return $e->getMessage();
        }
    }

    /**
     * 读操作 -->> 查询
     * @param  string $sql 查询sql
     * @return array       执行结果
     */
    public function query($sql)
    {
        try {
            $pdo = $this->pool->get();
            $result = $pdo->query($sql)->fetch();
            $data = [];
            foreach($result as $key => $value){
                $data[] = $value;
            }
            $this->pool->put($pdo);
            return $data;
        } catch (PDOException  $e) {
            $this->pool->put(null);
            return $e->getMessage();
        }
    }

    public function call($sql, $select_param = null)
    {
        $pdo = $this->pool->get();
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            if (isset($select_param)) {
                $result = $pdo->query($select_param)->fetchAll();
                $this->pool->put($pdo);
                return $result;
            }
            $this->pool->put($pdo);
            return true;
        } else {
            $this->pool->put($pdo);
            return false;
        }
    }
    /**
     * 写操作 -->> 增删改
     * @param  string $sql 查询sql
     * @return array       执行结果
     */
    public function execute($sql)
    {
        try {
            $pdo = $this->pool->get();
            $result = $pdo->exec($sql);
            $this->pool->put($pdo);
            return $result;
        } catch (PDOException  $e) {
            $this->pool->put(null);
            return $e->getMessage();
        }
    }
}