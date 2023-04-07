<?php

namespace app\classes;

class Request {

	public static function request($type) {
		if ($_SERVER['REQUEST_METHOD'] != strtoupper($type)) {
			throw new \Exception("A requisição tem que ser do tipo <b>{$type}</b>");
		}
		return true;
	}

}