<?php

namespace app\traits;

use app\classes\Load;

trait ControllerAndMethod {

	public function getController() {

		$folders = Load::load('controllers');

		$this->controller = ucfirst($this->controller()['controller']) . 'Controller';

		foreach ($folders->folders as $folder) {
			if (class_exists("\\app\\controllers\\" . $folder . "\\" . $this->controller)) {
				return "\\app\\controllers\\" . $folder . "\\" . $this->controller;
			}
		}
		return "\\app\\controllers\\erro\\NotFoundController";
	}

	public function getMethod($object) {

		if (!isset($this->controller()['method']) or empty($this->controller()['method'])) {
			return 'index';
		}

		if (!method_exists($object, $this->controller()['method'])) {
			throw new \Exception("Esse método não existe " . $this->controller()['method']);
		}

		return $this->controller()['method'];
	}

	public function parameter() {
		return $this->controller()['parameter'] ?? '';
	}
}