<?php

namespace App\Mfw;

class QueryBuilder
{
    private $sql;
    private $bind = [];

    public function select(string $table)
    {
        $this->sql = "SELECT * FROM `{$table}` t1";
        return $this;
    }

    public function selectFields(string $table, array $fields)
    {
        $sql = "SELECT (%s) FROM `{$table}` t1";
        $columns = array_values($fields);
        $this->sql = sprintf(str_replace(")", "", str_replace("(", "", $sql)), implode(', ', $columns));
        return $this;
    }

    public function selectOrderBy(string $table, string $value)
    {
        $this->sql = "SELECT * FROM `{$table}` ORDER BY `{$value}` ASC";
        return $this;
    }

    public function selectOrderByWhere(string $table, string $field, string $value1, string $value2)
    {
        $this->sql = "SELECT * FROM `{$table}` WHERE {$field} = '$value1' ORDER BY `{$value2}` ASC";
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

    public function join(string $table2, $value)
    {
        if (!$this->sql) {
            throw new \Exception("Select(), Update() or Delete() is required before join() method");
        }

        $this->sql .= " JOIN `{$table2}` t2 ON (t2.id = t1.fk_accounts) WHERE t2.id = {$value} ORDER BY t1.id DESC LIMIT 1";
        return $this;
    }

    public function innerJoin(string $table2, $value1, $value2, $tableWhere, $fieldWhere, $fieldBetween = null, $date1Between = null, $date2Between = null)
    {
        if (!$this->sql) {
            throw new \Exception("Select(), Update() or Delete() is required before InnerJoin() method");
        }

        if (!$fieldBetween && !$date1Between && !$date2Between) {
            $this->sql .= " JOIN `{$table2}` t2 ON (t2.id = t1.{$value1}) WHERE {$tableWhere}.{$fieldWhere} = {$value2}";
        } else {
            $this->sql .= " JOIN `{$table2}` t2 ON (t2.id = t1.{$value1}) WHERE {$tableWhere}.{$fieldWhere} = {$value2} AND {$fieldBetween} BETWEEN '{$date1Between}' AND '{$date2Between}' ";
        }

        return $this;
    }

    public function ThreeJoin(string $table2, string $table3, $fT1J1, $fT2J2, $tableWhere, $fieldTblWhere, $value, $tOn1, $tOn2)
    {
        if (!$this->sql) {
            throw new \Exception("Select(), Update() or Delete() is required before InnerJoin() method");
        }

        $this->sql .= " JOIN `{$table2}` t2 ON (t2.id = {$tOn1}.{$fT1J1})";
        $this->sql .= " JOIN `{$table3}` t3 ON (t3.id = {$tOn2}.{$fT2J2})";
        $this->sql .= " WHERE {$tableWhere}.{$fieldTblWhere} = '{$value}'";
        return $this;
    }

    public function ThreeJoin2Where(string $table2, string $table3, $t2OnField1, $t3OnField1, $fT1J1, $fT2J2, $tableWhere, $fieldTblWhere, $value, $tOn1, $tOn2, $tableWhere2, $fieldTblWhere2, $value2, $tOrder, $fieldOrder)
    {
        if (!$this->sql) {
            throw new \Exception("Select(), Update() or Delete() is required before InnerJoin() method");
        }

        $this->sql .= " JOIN `{$table2}` t2 ON (t2.{$t2OnField1} = {$tOn1}.{$fT1J1})";
        $this->sql .= " JOIN `{$table3}` t3 ON (t3.{$t3OnField1} = {$tOn2}.{$fT2J2})";
        $this->sql .= " WHERE {$tableWhere}.{$fieldTblWhere} = '{$value}' AND {$tableWhere2}.{$fieldTblWhere2} = '{$value2}'";
        $this->sql .= " ORDER BY {$tOrder}.{$fieldOrder} ASC";
        return $this;
    }

    public function getDataFaturaCreditCard($id, $idFatura)
    {
        if (!$this->sql) {
            throw new \Exception("Select(), Update() or Delete() is required before InnerJoin() method");
        }

        $this->sql .= " JOIN `credit_cards` cc ON (cc.id = t1.fk_credit_cards)";
        $this->sql .= " JOIN `flag_cards` fc ON (fc.id = cc.fk_flag_cards)";
        $this->sql .= " JOIN banks b ON (b.id = cc.fk_banks)";
        $this->sql .= " WHERE t1.fk_credit_cards = {$id} AND t1.id = {$idFatura}";
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