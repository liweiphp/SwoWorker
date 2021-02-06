<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-02-05
 * Time: 21:07
 */
namespace SwoWorker\Database\Driver;
use PDO;

class Mysql
{
    /**
     * 连接数据的地址
     * @var string
     */
//    CONST DRIVER_CLASS = 'mysql:host=127.0.0.1;dbname=test';

    protected $dbName = 'test';

    protected $host = '127.0.0.1';

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
     * 连接数据库驱动
     * @var PDO
     */
    private $pdo;

    public function __construct($config)
    {
        try {
            // 初始化执行数据库类
            $host = $config['host'] ?? $this->host;
            $dbName = $config['dbName'] ?? $this->dbName;
            $username = $config['username'] ?? $this->username;
            $password = $config['password'] ?? $this->password;
            $this->pdo = new PDO("mysql:host=".$host.";dbname=".$dbName.";", $username, $password);
            $this->pdo->query('SET NAMES UTF8');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            $result = $this->pdo->query($sql);
            $data = [];
            foreach($result as $key => $value){
                $data[] = $value;
            }
            return $data;
        } catch (PDOException  $e) {
            return $e->getMessage();
        }
    }

    public function call($sql, $select_param = null)
    {
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute()) {
            if (isset($select_param)) {
                return $this->pdo->query($select_param)->fetchAll();
            }
            return true;
        } else {
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
            return $this->pdo->exec($sql);
        } catch (PDOException  $e) {
            return $e->getMessage();
        }
    }
}