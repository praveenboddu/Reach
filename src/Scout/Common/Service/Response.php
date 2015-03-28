<?php 

namespace Scout\Common\Service;

use Symfony\Component\Validator\ConstraintViolationList;

Class Response
{
	const FORBIDDEN = 'error.forbidden';
	const NOT_FOUND = 'error.not_found';
	const BAD_REQUEST = 'error.bad_request';
	const INTERNAL_SERVER_ERROR = 'error.internal_server_error';
	const CONFLICT = 'error.conflict';
	const METHOD_NOT_ALLOWED = 'error.method_not_allowed';

	protected $data;

	protected $metadata;

	protected $errors;

	public function __construct()
	{
		$this->data = array();
		$this->metadata = array();
		$this->errors = new ConstraintViolationList();
	}

	public function getData()
	{
		return $this->data;
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function getMetaData()
	{
		return $this->metadata;
	}

	public function setMetaData($metadata)
	{
		$this->metadata = $metadata;
	}

	public function metaKeys()
	{
		return array_keys($this->metadata);
	}

	public function addMeta($key, $value)
	{
		$this->metadata[$key] = $value;
 	}

 	public function getMeta($key, $default = null)
 	{
 		if ($this->hasMeta($key)) {
 			return $this->metadata[$key];
 		}

 		return $default;
 	}

 	public function hasMeta($key)
 	{
 		return array_key_exists($key, $this->metadata);
 	}

 	public function removeMeta($key)
 	{
 		unset($this->metadata[$key]);
 	}

 	public function isOk()
 	{
 		if (count($this->errors) === 0) {
 			return true;
 		}

 		return false;
 	}

 	public function getErrors()
 	{
 		return $this->errors;
 	}

 	public function addError($error, $message = '')
 	{
 		if (!$error instanceof Violation) {
 			$error = new Violation($message, array(), null, '', null, null, $error);
 		}

 		$this->errors->add($error);
 	}

 	public function addErrors(ConstraintViolationList $errors)
 	{
 		$this->errors->addAll($errors);
 	}
}

