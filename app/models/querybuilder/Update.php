<?php

namespace app\models\querybuilder;

use app\classes\App;

class Update
{
    /**
     * @var mixed
     */
    private $sql;
    /**
     * @var mixed
     */
    private $data;
    /**
     * @var mixed
     */
    private $where;
    /**
     * @var mixed
     */
    private $table;

    /**
     * @param $data
     * @param $where
     * @param $table
     */
    public function __construct($data, $where, $table)
    {
        $this->data = (array) $data;
        $this->where = $where;
        $this->table = $table;
    }

    public function create()
    {
        $this->sql = "update {$this->table} set ";

        foreach ($this->data as $field => $value) {
            $this->sql .= "{$field} = :{$field}, ";
        }

        $this->sql = rtrim($this->sql, ', ');

        $fieldWhere = (array_keys($this->where));

        $this->sql .= " where {$fieldWhere[0]} = :{$fieldWhere[0]}";

        return $this;
    }

    /**
     * @return mixed
     */
    public function save()
    {
        $connection = App::get('connection');

        $update = $connection->prepare($this->sql);

        $data = array_merge($this->data, $this->where);

        $update->execute($data);

        return $update->rowCount();
    }
}
