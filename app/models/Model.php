<?php

namespace app\models;

use app\classes\App;
use app\traits\CollectionDb;
use app\traits\PersistDb;

abstract class Model {
	use CollectionDb, PersistDb;

	public $connection;

	public function __construct() {
		$this->connection = App::get('connection');
	}

	public function delete($field, $value) {
		$sql = "delete from {$this->table} where {$field} = ?";
		$delete = $this->connection->prepare($sql);
		$delete->bindValue(1, $value);
		$delete->execute();

		return $delete->rowCount();
	}
}
