<?php

namespace app\classes;

use app\traits\Sanitize;
use app\traits\Validate;

class Validator {

	use Validate, Sanitize;

	public static function validate(\Closure $callback) {
		if (is_callable($callback)) {
			$callback();

			return self::dataSanitized();
		}
	}

}