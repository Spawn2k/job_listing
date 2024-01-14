<?php

namespace App\model;

use App\db\DbFactory;
use Exception;
use PDO;
use stdClass;

trait Model
{
    use DbFactory;

    public function find(string|int $id, string $column = 'id', string $table = '', string $select = '*'): stdClass | bool
    {
        $table = $table ? $table : $this->table;
        $sql = "SELECT $select FROM $table WHERE {$column} = ?";

        try {
            $stmt = $this->db()->prepare($sql);
            $stmt->execute([$id]);
            $data = $stmt->fetch();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $data ;
    }

    public function findAll(string|int $id, string $column = 'id', string $table = '', string $select = '*'): bool | array
    {
        $table = $table ? $table : $this->table;
        $sql = "SELECT $select FROM $table WHERE {$column} = ?";

        try {
            $stmt = $this->db()->prepare($sql);
            $stmt->execute([$id]);
            $data = $stmt->fetchAll();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $data ;
    }


    public function insert(array $data = [], string $table = ''): void
    {

        $data = $this->filterInput($data);
        $table = $table ? $table : $this->table;
        $keys = array_keys($data);
        $query = "INSERT INTO $table (" . implode(',', $keys) . ") VALUES (:" . implode(', :', $keys) . ")";
        try {
            $stmt = $this->db()->prepare($query);
            $stmt->execute($data);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }


    public function handleUpdate(string|int $id, array $data, string $column = 'id', string $table = ''): void
    {

        $data = $this->filterInput($data);
        $table = $table ? $table : $this->table;
        $sql = "UPDATE $table SET ";
        $keys = array_keys($data);

        foreach ($keys as $key) {
            $sql .= $key . " = :" . $key . ", ";
        }

        $sql = trim($sql, ', ');
        $sql .= " WHERE $column = :$column";
        $data[$column] = $id;

        try {
            $stmt = $this->db()->prepare($sql);
            $stmt->execute($data);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
            exit();
        }
    }

    public function filterInput(array $inputData): array
    {
        $keyFlip = array_flip($this->fillable);
        $inputData = array_intersect_key($inputData, $keyFlip);
        $filterData = [];

        foreach($inputData as $key => $input) {
            $filterData[$key] = htmlspecialchars($input);
        }

        return $filterData;
    }

    public function handleDestroy(string|int $id, string $table = '', string $column = 'id'): void
    {
        $data = [];
        $data[$column] = $id;
        $table = $table ? $table : $this->table;
        $sql = "DELETE FROM $table WHERE $column = :$column";

        try {
            $stmt = $this->db()->prepare($sql);
            $stmt->execute($data);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function whereLike(array $column, string $value, string $table = ''): array
    {
        $table = $table ? $table : $this->table;
        $sql = "SELECT * FROM $table WHERE ";
        $data = [];

        foreach ($column as $parameter) {
            $sql .= $parameter . " LIKE CONCAT('%', :$parameter, '%') OR ";
            $data[$parameter] = $value;
        }

        $sql = trim($sql, ' OR');

        try {
            $stmt = $this->db()->prepare($sql);
            $stmt->execute($data);
            $result = $stmt->fetchAll();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            exit();
        }

        return $result;
    }

    public function whereIn(string|int $id, string $column = 'id', string $table = ''): array
    {

        $table = $table ? $table : $this->table;
        $id = preg_replace("/,([\s])+/", ",", $id);
        $searArray = explode(',', $id);

        $sql = "SELECT * FROM $table WHERE $column IN (:" . implode(',:', array_keys($searArray)) . ")";

        try {
            $stmt = $this->db()->prepare($sql);

            foreach ($searArray as $key => $id) {
                $stmt->bindValue(":$key", $id);
            }

            $stmt->execute();
            $result = $stmt->fetchAll();

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage);
        }

        return $result;
    }

    public function getCount(): int
    {
        $sql = "SELECT count(id) as 'count' from $this->table";
        try {

            $stmt = $this->db()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());

        }

        return $result->count;
    }

    public function limit(int|string $count, int|string $offset): array
    {
        $sql = "SELECT * FROM $this->table LIMIT :count offset :offset";

        try {

            $stmt = $this->db()->prepare($sql);
            $stmt->bindValue(':count', $count, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());

        }

        return $result;
    }

    public function setTable(string $table): self
    {
        $this->table = $table;

        return $this;
    }

    public function setFillable(array $fillable)
    {
        $this->fillable = $fillable;
        return $this;
    }

    public function searchLike(string $location, string $keyWords = '']): array
    {
        data = [];
        $sql = "SELECT * FROM $this->table WHERE state LIKE Concat('%', :state, '%')";
        $searchSql = "And (title like CONCAT('%', :title, '%') 
        or description like concat('%', :description, '%') 
        or requirements like concat('%', :requirements, '%'))";
        $sql .= $searchSql;
        $data['state'] = $location;
        dump($sql);
        // $stmt = $this->db()->prepare($sql);
        // $stmt->execute($data);
        // $result = $stmt->fetchAll();
        // return $result;
    }
}
