<?php

namespace ScoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ScoutBundle:Default:index.html.twig', array('name' => 'praveen'));
    }
}
