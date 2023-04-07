<?php

namespace app\classes;

use app\classes\Reflection;

class CheckAndEexecutePermission {

	public static function execute($object) {

		$reflection = new Reflection($object);

		if ($reflection->getNamespace() == 'app\controllers\admin' and $reflection->getName() != 'app\controllers\admin\AdminController') {
			Permissions::execute();
		}
	}

}