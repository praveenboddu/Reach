<?php

namespace Scout\Common\Service;

use Symfony\Component\Validator\ConstraintViolation;

class Violation extends ConstraintViolation
{

	public function __construct
	(
		$message,
		array $params = array(),
		$root = null,
		$propertyPath = '',
		$invalidValue = null,
		$pluralization = null,
		$code = null
	) {
		parent::__construct($message, $message, $params, $root, $propertyPath, $invalidValue, $pluralization, $code);
	}
}