<?php
namespace Arthur\Core\App;
use PDO;
use PDOException;

class Database {
    private string $host = HOST;
    private string $username = USERNAME;
    private string $password = PASSWORD;
    private string $database = DATABASE;
    private PDO $db_handler;
    private object $statement;

    /**
     * Database constructor.
     */
    public function __construct(){
        $data_source_name = "mysql:host={$this->host};dbname={$this->database}";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            $this->db_handler = new PDO($data_source_name, $this->username, $this->password, $options);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @param string $query
     * @return void
     */
    public function prepare(string $query): void
    {
        $this->statement = $this->db_handler->prepare($query);
    }

    /**
     * @param $param
     * @param $value
     * @param null $type
     */
    public function bind($param, $value, $type = null): void
    {
        if (is_null($type)):
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        endif;
        $this->statement->bindValue($param, $value, $type);
    }

    /**
     * @return void
     */
    public function execute(): void {
        $this->statement->execute();
    }

    /**
     * @return array
     */
    public function fetchAll(): array
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function fetch(): array
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return int
     */
    public function rowCount(): int
    {
        return $this->statement->rowCount();
    }

    public function quote(string $string): string {
        return $this->db_handler->quote($string);
    }
}
