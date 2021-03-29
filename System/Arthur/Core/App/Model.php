<?php
namespace Arthur\Core\App;
/**
 * @author Adam Arthur Faizal
 *
 **/

abstract class Model {
    /**
     * @var Database
     */
    protected Database $db;

    /**
     * @var string
     */
    protected string $tableName;

    /**
     * Model constructor.
     */
    public function __construct(){
        $this->db = new Database();
        if (isset($_SERVER['REDIRECT_URL'])):
            $this->tableName = strtolower(explode('/', $_SERVER['REDIRECT_URL'])[2]);
        endif;
    }

    /**
     * @return array
     */
    public function all(): array {
        $query = "SELECT * FROM {$this->tableName}";
        $this->db->prepare($query);
        $this->db->execute();
        return $this->db->fetchAll();
    }

    /**
     * @param $id
     * @return array
     */
    public function single($id): array {
        $query = "SELECT * FROM {$this->tableName} WHERE id = :id";
        $this->db->prepare($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->fetch();
    }

    /**
     * @return int
     */
    public function add()
    {

    }

    /**
     * @return int
     */
    public function save()
    {

    }

    /**
     * @param $id
     * @return int
     */
    public function remove($id): int {
        $query = "DELETE FROM {$this->tableName} WHERE id = :id";
        $this->db->prepare($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * @return mixed
     */
    public function look()
    {

    }
}