<?php

namespace Scout\CoreBundle\View;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;

use Scout\Common\Service\Response as ServiceResponse;

class ViewHandler extends \FOS\RestBundle\View\ViewHandler
{
	public function createResponse(View $view, Request $request, $format)
	{
		if ($data = $view->getData()) {
			if ($data instanceof ServiceResponse) {
				$response = $data;
				$service = $this->container->get('scout_core.serializer.handler.service_response');
				$attributes = $request->attributes;

				$resource = $attributes->has('subResource') ? $attributes->get('subResource') : $attributes->get('resource');
				$service->setResponse($resource);

				if ($response->isOk()) {
					switch ($request->getMethod()) {
						case 'POST':
							$id = $response->getData();
							if (!empty($id) && !is_array($id)) {
								$route = $request->get('_route');

								if (preg_match('|^post_([a-z]*)s$|', $route, $matches)) {
									$new_route = 'get_'. $matches[1];

									$location = $this->getRouter()->generate($new_route, array('id' => $id), true);

									$response = $view->getResponse();
									$response->headers->set('Location', $location);
								}
							}
							$view->setStatusCode(Codes::HTTP_CREATED);
							break;
						default:
							break;
					}
				} else {
					$errors = $response->getErrors();

					$error = $errors[0];

					switch ($error->getCode()) {
						case ServiceResponse::FORBIDDEN:
							$view->setStatusCode(Codes::HTTP_FORBIDDEN);
							break;
						case ServiceResponse::NOT_FOUND:
							$view->setStatusCode(Codes::HTTP_NOT_FOUND);
							break;
						case ServiceResponse::CONFLICT:
							$view->setStatusCode(Codes::HTTP_CONFLICT);
							break;
						case ServiceResponse::METHOD_NOT_ALLOWED:
							$view->setStatusCode(Codes::HTTP_METHOD_NOT_ALLOWED);
							break;
						case ServiceResponse::BAD_REQUEST:
							$view->setStatusCode(Codes::HTTP_BAD_REQUEST);
							break;
					}
				}
			}
		}

		return parent::createResponse($view, $request, $format);
	}
}