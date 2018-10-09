<?php

namespace App\Mfw;

class QueryBuilder
{
    private $sql;
    private $bind = [];

    public function select(string $table)
    {
        $this->sql = "SELECT * FROM `{$table}`";
        return $this;
    }

    public function selectOrderBy(string $table, string $value)
    {
        $this->sql = "SELECT * FROM `{$table}` ORDER BY `{$value}` ASC";
        return $this;
    }

    public function insert(string $table, array $data)
    {
        $sql = "INSERT INTO `{$table}` (%s) VALUES (%s)";
        $columnsDate = ['created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $data = array_merge($data, $columnsDate);
        $columns = array_keys($data); 
        $values = array_fill(0, count($columns), '?');
        $this->bind = array_values($data);
        $this->sql = sprintf($sql, implode(', ', $columns), implode(', ', $values));
        return $this;
    }

    public function update(string $table, array $data)
    {
        $sql = "UPDATE `{$table}` SET %s";
        $columnsDate = ['updated_at' => date("Y-m-d H:i:s")];
        $data = array_merge($data, $columnsDate);
        $columns = array_keys($data);

        foreach ($columns as &$column) {
            $column = $column . '=?';
        }

        $this->bind = array_values($data);
        $this->sql = sprintf($sql, implode(', ', $columns));
        return $this;
    }

    public function delete(string $table)
    {
        $this->sql = "DELETE FROM `{$table}`";
        return $this;
    }

    public function where(array $conditions)
    {
        if ($conditions == []) {
            return $this;
        }

        if (!$this->sql) {
            throw new \Exception("Select(), Update() or Delete() is required before where() method");
        }

        $columns = array_keys($conditions);

        foreach ($columns as &$column) {
            $column = $column . '=?';
        }

        $this->bind = array_merge($this->bind, array_values($conditions));
        $this->sql .= ' WHERE ' . implode(' AND ', $columns);
        return $this;
    }

    public function between(string $field, string $date1, string $date2)
    {

        if (!$this->sql) {
            throw new \Exception("Select(), Update() or Delete() is required before between() method");
        }

        foreach ($columns as &$column) {
            $column = $column . '=?';
        }

        $this->sql .= " AND " . $field . " BETWEEN '". $date1 ."' AND '". $date2 ."' ORDER BY {$field}";
        return $this;
    }

    public function getData() :\stdClass
    {
        $query = new \stdClass;
        $query->sql = $this->sql;
        $query->bind = $this->bind;
        $this->sql = null;
        $this->bind = [];
        return $query;
    }
}