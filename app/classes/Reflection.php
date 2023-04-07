<?php

namespace app\classes;

class Reflection {

	private $reflection;

	public function __construct($object) {
		$this->reflection = new \ReflectionObject($object);
	}

	public function getNamespace() {
		return $this->reflection->getNamespaceName();
	}

	public function getName() {
		return $this->reflection->getName();
	}

}