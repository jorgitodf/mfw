<?php

namespace App\Mfw;

use Pimple\Container;
use App\Mfw\QueryBuilder;

abstract class Model
{
    protected $db;
    protected $table;
    protected $queryBuilder;

    public function __construct(Container $cont)
    {
        $this->db = $cont['db'];
        $this->queryBuilder = new QueryBuilder;

        if (!$this->table) {
            $table = explode('\\', get_called_class());
            $table = array_pop($table);
            $this->table = strtolower($table);
        }
    }

    public function get()
    {
        $query = $this->queryBuilder->select($this->table)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function all()
    {
        $query = $this->queryBuilder->select($this->table)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function allOrderBy($value)
    {
        $query = $this->queryBuilder->selectOrderBy($this->table, $value)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function allOrderByWhere(string $field, string $value1, string $value2)
    {
        $query = $this->queryBuilder->selectOrderByWhere($this->table, $field, $value1, $value2)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById(array $conditions)
    {
        $query = $this->queryBuilder->select($this->table)->where($conditions)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAllById(array $conditions)
    {
        $query = $this->queryBuilder->select($this->table)->where($conditions)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function between(array $conditions_1, string $field, string $date1, string $date2)
    {
        $query = $this->queryBuilder->select($this->table)->where($conditions_1)->between($field, $date1, $date2)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saldo(string $table2, $value)
    {
        $query = $this->queryBuilder->select($this->table)->join($table2, $value)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function ThreeJoin($fields, $table2, $table3, $fT1J1, $fT2J2, $tableWhere, $fieldTblWhere, $value, $tOn1, $tOn2)
    {
        $query = $this->queryBuilder->selectFields($this->table, $fields)->ThreeJoin($table2, $table3, $fT1J1, $fT2J2, $tableWhere, $fieldTblWhere, $value, $tOn1, $tOn2)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function ThreeJoin2Where($fields, $table2, $table3, $t2OnField1, $t3OnField1, $fT1J1, $fT2J2, $tableWhere, $fieldTblWhere, $value, $tOn1, $tOn2, $tableWhere2, $fieldTblWhere2, $value2, $tOrder, $fieldOrder)
    {
        $query = $this->queryBuilder->selectFields($this->table, $fields)->ThreeJoin2Where($table2, $table3, $t2OnField1, $t3OnField1, $fT1J1, $fT2J2, $tableWhere, $fieldTblWhere, $value, $tOn1, $tOn2, $tableWhere2, $fieldTblWhere2, $value2, $tOrder, $fieldOrder)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function innerJoin($table2, $value1, $value2, $tableWhere, $fieldWhere, $fieldBetween = null, $date1Between = null, $date2Between = null)
    {
        $query = $this->queryBuilder->select($this->table)->innerJoin($table2, $value1, $value2, $tableWhere, $fieldWhere, $fieldBetween, $date1Between, $date2Between)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getDataFaturaCreditCard($fields, $idCredCard, $idFatura)
    {   
        $query = $this->queryBuilder->selectFields($this->table, $fields)->getDataFaturaCreditCard($idCredCard, $idFatura)->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findBy(array $conditions)
    {
        $query = $this->queryBuilder->select($this->table)->where($conditions)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findById(array $fields, array $conditions)
    {
        $query = $this->queryBuilder->selectFields($this->table, $fields)->where($conditions)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(array $data) 
    {
        if (array_sum(array_map('is_array', $data)) == 0) {
            $query = $this->queryBuilder->insert($this->table, $data)->getData();
            $stmt = $this->db->prepare($query->sql);
            $stmt->execute($query->bind);
            $result = $this->getById(['id' => $this->db->lastInsertId()]);
        } else {
            foreach ($data as $value) {
                $query = $this->queryBuilder->insert($this->table, $value)->getData();
                $stmt = $this->db->prepare($query->sql);
                $stmt->execute($query->bind);
                $result = $this->getById(['id' => $this->db->lastInsertId()]);
            }
        }
        return $result;
    }

    public function update(array $conditions, array $data)
    {
        $query = $this->queryBuilder->update($this->table, $data)->where($conditions)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        $result = $this->getById(['id' => $conditions['id']]);
        
        return $result;
    }

    public function delete(array $conditions)
    {
        $result = $this->getById(['id' => $conditions['id']]);
        $query = $this->queryBuilder->delete($this->table)->where($conditions)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        
        return $result;
    }
}