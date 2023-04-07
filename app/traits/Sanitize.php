<?php

namespace app\traits;

trait Sanitize {

	private static $sanitized = [];

	public function sanitize(...$indexes) {
		foreach ($indexes as $index) {
			if (!strpos($index, ':')) {
				throw new \Exception("Tem alguma coisa errada com a sua validação no indice {$index}, verifique se tem os dos pontos");
			}

			list($fieldToValidate, $typeValidate) = explode(':', $index);

			switch ($typeValidate) {
			case 's':
				static::$sanitized[$fieldToValidate] = $this->string($_POST[$fieldToValidate]);
				break;
			case 'i':
				static::$sanitized[$fieldToValidate] = $this->int($_POST[$fieldToValidate]);
				break;
			}
		}

		return new Static;
	}

	public function string($string) {
		return filter_var($string, FILTER_SANITIZE_STRING);
	}

	public function int($int) {
		return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
	}

	public static function dataSanitized() {
		if (empty(static::$sanitized)) {
			throw new \Exception("Opa, você esqueceu de proteger seus dados, use sempre o sanitize");
		}

		return (object) static::$sanitized;
	}

}