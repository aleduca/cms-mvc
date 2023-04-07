<?php

namespace app\classes;

class App {

	private static $bind = [];

	public static function binds($binds) {
		foreach ($binds as $key => $value) {
			static::bind($key, $value);
		}
	}

	public static function bind($key, $value) {
		if (!isset(static::$bind[$key])) {
			static::$bind[$key] = $value;
		}
	}

	public static function get($key) {
		if (!isset(static::$bind[$key])) {
			throw new \Exception("Esse indice {$key} nao existe no container");
		}

		return static::$bind[$key];
	}

}
