<?php

namespace App\Models;

use Pimple\Container;

class Users
{
    private $db;
    private $table;

    public function __construct(Container $cont)
    {
        $this->db = $cont['db'];
        $this->table = "users";
    }

    public function get()
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function where($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}