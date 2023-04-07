<?php

namespace app\classes;
use \Acme\Classes\Url as Url;

class Parameters {

	public static function getParameter($numeroIndex) {

		$explodeUrl = explode('/', URL::getUrl());
		return $explodeUrl[$numeroIndex];

	}

}