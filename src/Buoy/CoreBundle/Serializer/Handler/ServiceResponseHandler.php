<?php

namespace Buoy\CoreBundle\Serializer\Handler;

use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\GenericSerializationVisitor;

use Buoy\Common\Service\Response;

class ServiceResponseHandler implements SubscribingHandlerInterface
{
	
	/**
	* @var string
	*/
	protected $response;

	/**
	* @return array
	*/
	public static function getSubscribingMethods()
	{
		var_dump('im here');
		return array(
			array(
				'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
				'format' => 'json',
				'type' => 'Scout\Common\Service\Response',
				'method' => 'serializeServiceResponseToJson'
			)
		);
	}

	public function setResponse($response)
	{
		$this->response = $response;
	}

	public function serializeServiceResponseToJson(
		JsonSerializationVisitor $visitor,
		Response $response,
		array $type,
		Context $context
	) {
		$this->convertServiceResponseToArray($visitor, $response, $context);
	}

	private function convertServiceResponseToArray(
		GenericSerializationVisitor $visitor,
		Response $response,
		Context $context
	) {
		var_dump('in ServiceResponseHandler');
		$output = array();
		$status = $response->isOk();

		$context->setSerializeNull(true);

		if (!$status) {
			$errors = $response->getErrors();
			$error = $errors[0];

			switch ($error->getCode()) {
				case Response::FORBIDDEN:
					$output['status'] = 403;
					break;
				case Response::NOT_FOUND:
					$output['status'] = 404;
					break;
				default:
					$output['status'] = 400;
					break;
			}

			$output['code'] = $error->getCode();
			$output['message'] = $error->getMessage();

		} else {
			$data = $response->getData();
			$type = gettype($data);

			if ($type === 'array' && !isset($data[0])) {
				$type = 'dict';
			}
			switch ($type) {
				case 'string':
				case 'integer':
					$output['id'] = $data;
					break;
				case 'array':
					$output[$this->response] = $visitor->getNavigator()->accept($data, null, $context);
					$meta = $response->getMetaData();

					if (isset($meta['count'])) {
						$output['count'] = $meta['count'];
					}

					if (isset($meta['next'])) {
						$output['next'] = $meta['next'];
					}

					if (isset($meta['last'])) {
						$output['last'] = $meta['last'];
					}
					break;
				default:
					$output = $visitor->getNavigator()->accept($data, null, $context);
					break;
			}
		}

		$visitor->setRoot($output);
	}

}