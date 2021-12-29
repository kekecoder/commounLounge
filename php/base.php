<?php

class Base
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($table, $fields = [])
    {
        $columns = implode(',', array_keys($fields));
        $values = ':' . implode(',', array_keys($fields));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

        if ($stmt = $this->pdo->prepare($sql)) {
            foreach ($fields as $key => $data) {
                $stmt->bindValue(':' . $key, $data);
            }
            $stmt->execute();

            return $this->pdo->lastInsertId();
        }
    }

    public function update($table, $user_id, $fields = [])
    {
        $columns = '';
        $i = 1;

        foreach ($fields as $name => $value) {
            $columns .= "{$name} = :{$name}";

            if ($i < count($fields)) {
                $columns .= ", ";
            }
            $i++;
        }

        $sql = "UPDATE {$table} SET {$columns} WHERE id = {$user_id}";

        if ($stmt = $this->pdo->prepare("$sql")) {
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }

            $stmt->execute();
        }
    }

    public function remove($table, $array)
    {
        $sql = "DELETE FROM {$table}";
        $where = " WHERE";

        foreach ($array as $name => $value) {
            $sql .= "{$where} = :{$name}";
            $where = " AND ";
        }

        if ($stmt = $this->pdo->prepare($sql)) {
            foreach ($array as $name => $value) {
                $stmt->bindValue(':' . $name, $value);
            }
        }
    }
}
