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

    public function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(array $data) 
    {
        $sql = "INSERT INTO {$this->table} (name, email, phone, password, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($data));
        $result = $this->getById($this->db->lastInsertId());

        return $result;
    }

    public function update($id, array $data)
    {
        $sql = "UPDATE {$this->table} SET name=?, email=?, phone=?, password=?, updated_at=NOW() WHERE id=?";
        $data = array_merge($data, [$id]);
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($data));
        $result = $this->getById($id);

        return $result;
    }

    public function delete($id)
    {
        $result = $this->getById($id);
        $sql = "DELETE FROM {$this->table} WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        
        return $result;
    }
}