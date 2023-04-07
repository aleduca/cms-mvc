<?php

namespace app\models\admin;

use app\models\Model;

class Permissions extends Model
{
    protected $table = 'permissoes';
    protected $sql;
    protected $binds;

    public function userPermissions($user)
    {
        $this->sql = "select * from {$this->table} where administrador = :administrador";

        $this->binds = [
            'administrador' => $user,
        ];

        return $this;
    }

    public function findPermission($method, $controller, $admin)
    {
        $sql = "select * from {$this->table} where administrador = :administrador and controller = :controller and method = :method";
        $select = $this->connection->prepare($sql);
        $select->bindValue('administrador', $admin);
        $select->bindValue('controller', $controller);
        $select->bindValue('method', $method);

        $select->execute();

        return $select->rowCount();
    }

    public function deletePermission($method, $controller, $administrador)
    {
        $sql = "delete from {$this->table} where administrador = :administrador and controller = :controller and method =:method";
        $delete = $this->connection->prepare($sql);
        $delete->bindValue('administrador', $administrador);
        $delete->bindValue('controller', $controller);
        $delete->bindValue('method', $method);

        $delete->execute();

        return $delete->rowCount();
    }
}
