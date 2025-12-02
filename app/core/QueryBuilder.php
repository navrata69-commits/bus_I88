<?php

namespace bus\Project\core;

class QueryBuilder
{
    protected $db;
    protected $table;
    protected $columns = ['*'];
    protected $joins = [];
    protected $conditions = [];
    protected $bindings = [];
    protected $whereRaw = [];
    protected $limit;
    protected $groupBy = [];
    protected $orderBy = [];
    protected $havings = [];

    public function __construct(\PDO $db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    public function select(array $columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->orderBy[] = "$column $direction";
        return $this;
    }

    
    public function orderByRaw($raw)
    {
        $this->orderBy[] = $raw;
        return $this;
    }

    public function havingRaw($condition, $params = [])
    {
        $this->havings[] = $condition;
        $this->bindings = array_merge($this->bindings, $params);
        return $this;
    }


    public function groupBy($columns)
    {
        if (is_array($columns)) {
            $this->groupBy = array_merge($this->groupBy, $columns);
        } else {
            $this->groupBy[] = $columns;
        }
        return $this;
    }

    public function whereRaw($raw, $params = [])
    {
        $this->whereRaw[] = $raw;

        // jika ada binding (misal :start, :end), masukkan
        foreach ($params as $key => $value) {
            $this->bindings[$key] = $value;
        }

        return $this;
    }

    public function join($table, $firstColumn, $operator = '=', $secondColumn = null, $type = 'INNER')
    {
        if (is_null($secondColumn)) {
            $secondColumn = $operator;
            $operator = '=';
        }

        $this->joins[] = "$type JOIN $table ON $firstColumn $operator $secondColumn";
        return $this;
    }

    public function leftJoin($table, $firstColumn, $operator = '=', $secondColumn = null)
    {
        return $this->join($table, $firstColumn, $operator, $secondColumn, 'LEFT');
    }


    public function where($column, $operator, $value)
    {
        $param = str_replace('.', '_', $column); // unique parameter key
        $this->conditions[] = "$column $operator :$param";
        $this->bindings[":$param"] = $value;
        return $this;
    }

    public function get()
    {
        $query = $this->buildQuery();
        $stmt = $this->db->prepare($query);

        foreach ($this->bindings as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function first()
    {
        $this->limit(1);
        $results = $this->get();
        return $results ? $results[0] : null;
    }

    private function buildQuery()
    {
        $columns = implode(', ', $this->columns);
        $query = "SELECT $columns FROM {$this->table}";

        if ($this->joins) {
            $query .= ' ' . implode(' ', $this->joins);
        }

        if ($this->conditions) {
            $query .= ' WHERE ' . implode(' AND ', $this->conditions);
        }

        if ($this->whereRaw) {
            if (strpos($query, 'WHERE') === false) {
                $query .= ' WHERE ' . implode(' AND ', $this->whereRaw);
            } else {
                $query .= ' AND ' . implode(' AND ', $this->whereRaw);
            }
        }


        if ($this->groupBy) {
            $query .= ' GROUP BY ' . implode(', ', $this->groupBy);
        }

        if (!empty($this->havings)) {
            $query .= ' HAVING ' . implode(' AND ', $this->havings) . ' ';
        }

        if (!empty($this->orderBy)) {
            $query .= ' ORDER BY ' . implode(', ', $this->orderBy);
        }

        if ($this->limit) {
            $query .= " LIMIT {$this->limit}";
        }

        return $query;
    }

    public function limit($count)
    {
        $this->limit = $count;
        return $this;
    }

    public function paginate($perPage = 15, $page = 1)
    {
        $offset = ($page - 1) * $perPage;
        $this->limit = "$offset, $perPage"; // Gunakan offset untuk pagination

        $query = $this->buildQuery();
        $stmt = $this->db->prepare($query);

        foreach ($this->bindings as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Hitung total records
        $countQuery = "SELECT COUNT(*) as total FROM {$this->table}";
        if ($this->conditions) {
            $countQuery .= ' WHERE ' . implode(' AND ', $this->conditions);
        }
        $countStmt = $this->db->prepare($countQuery);
        foreach ($this->bindings as $key => $value) {
            $countStmt->bindValue($key, $value);
        }
        $countStmt->execute();
        $total = $countStmt->fetch(\PDO::FETCH_ASSOC)['total'];

        return [
            'data' => $data,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function whereIn($column, array $values)
    {
        if (empty($values)) {
            return $this;
        }

        // Buat placeholder parameter sesuai jumlah nilai di array
        $placeholders = [];
        foreach ($values as $index => $value) {
            $param = str_replace('.', '_', $column) . "_in_" . $index;
            $placeholders[] = ":$param";
            $this->bindings[":$param"] = $value;
        }

        $placeholderString = implode(', ', $placeholders);
        $this->conditions[] = "$column IN ($placeholderString)";

        return $this;
    }


}
