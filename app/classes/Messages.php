<?php

namespace app\classes;

class Messages {

	/**
	 * @param $message
	 */
	public function success($message) {
		return '<span class="message_success"><i class="fa fa-check-circle-o"></i> ' . $message . '</span>';
	}

	/**
	 * @param $message
	 */
	public function danger($message) {
		return '<span class="message_danger"><i class="fa fa-check-circle-o"></i> ' . $message . '</span>';

	}

}