<?php

namespace app\classes;

use app\models\admin\Permissions;

class ControllersPermission {

	private $methods = [
		'index', 'show', 'edit', 'update', 'create', 'store', 'destroy',
	];

	private $exclude = [
		'AdminController.php',
	];

	private $controllersName = [];

	private $permissions;

	private function folderControllers() {
		$files = new \DirectoryIterator('../app/controllers/admin');

		$controllers = [];

		foreach ($files as $file) {
			if (!$file->isDot() and !in_array($file->getFileName(), $this->exclude)) {
				$controllers[] = $file->getFileName();
			}
		}

		return $controllers;
	}

	private function controllers() {

		$controllers = $this->folderControllers();

		$controllers = array_map(function ($controller) {
			list($filename) = explode('.', $controller);

			if (strstr($filename, 'Admin')) {
				return substr($filename, strlen('Admin'), strlen($filename));
			}

			return $filename;
		}, $controllers);

		return $controllers;

	}

	public function permission($user) {

		$permissions = new Permissions;
		$this->permissions = $permissions->userPermissions($user)->get();

		$controllers = $this->controllers();

		foreach ($controllers as $controller) {
			$this->controllersAndPermissions($controller);
		}

		return $this->controllersName;
	}

	private function controllersAndPermissions($controller) {
		if (!$this->permissions) {
			$this->permissionNotFound($controller);
		} else {
			$this->permissionsFound($controller);
		}
	}

	private function permissionNotFound($controller) {
		foreach ($this->methods as $method) {
			if (!isset($this->controllersName[$controller][$method])) {
				$this->controllersName[$controller][$method] = 'danger';
			}
		}
	}

	private function permissionsFound($controller) {
		foreach ($this->permissions as $permission) {
			if ($permission->controller == $controller) {
				$this->controllersName[$controller][$permission->method] = 'success';
			}

			foreach ($this->methods as $method) {
				if (!isset($this->controllersName[$controller][$method])) {
					$this->controllersName[$controller][$method] = 'danger';
				}
			}
		}
	}

}