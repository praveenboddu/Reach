<?php


namespace Buoy\BeaconBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\RestBundle\Controller\Annotations\Post;

class SecurityController extends FOSRestController
{
    /**
     * @Post("/auth")
     * Creates a security token for the user
     */
    public function tokenCreateAction(Request $request)
    {
        $username = $request->get('username', NULL);
        $password = $request->get('password', NULL);

        if (!isset($username) || !isset($password)){
            throw new BadRequestHttpException("You must pass username and password fields");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('UserBundle\Entity\User')->findOneBy(['username' => $username]);

        if (!$user instanceof \UserBundle\Entity\User) {
            throw new AccessDeniedHttpException("No matching user account found");
        }

        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $valid = $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
        if (!$valid) {
            throw new AccessDeniedHttpException("Password does not match password on record");
        }

        //User checks out, generate an api key
        $user->refreshToken();
        $em->persist($user);
        $em->flush();

        return new JsonResponse(array("apikey" => $user->getApiKey()));
    }
}