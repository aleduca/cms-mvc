<?php

namespace app\classes;

class Sanitize {

	public static function search() {
		return filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING);
	}

	public static function string($string) {
		return filter_var($string, FILTER_SANITIZE_STRING);
	}

	public static function int($int) {
		return filter_var($int, FILTER_SANITIZE_STRING);
	}

}