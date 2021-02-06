<?php
/**
 * 数据库DAO -->>> 对数据库进行操作的类
 */
class Db
{
    /**
     * 连接数据的地址
     * @var string
     */
    CONST DRIVER_CLASS = 'mysql:host=127.0.0.1;dbname=test';

    /**
     * 数据库的用户名
     * @var string
     */
    CONST USERNAME = 'mymovie';

    /**
     * 数据库的密码
     * @var string
     */
    CONST PASSWORD = 'Ww@3613040';

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

    public function __construct()
    {
        try {
            // 初始化执行数据库类
            $this->pdo = new PDO(self::DRIVER_CLASS, self::USERNAME, self::PASSWORD);
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
            // return (count($data) <= 1) ? $data[0] : $data ;

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
            // throw new \Exception($e->getMessage(), 500);
            return $e->getMessage();
        }
    }

    //------------------
    //属性get | set 方法
    //------------------

    /**
     * 获取系统错信息
     */
    public function getError()
    {
        return $this->error;
    }

    public function write($data)
    {
        file_put_contents("log.txt", $data."\n", FILE_APPEND);
    }
}
