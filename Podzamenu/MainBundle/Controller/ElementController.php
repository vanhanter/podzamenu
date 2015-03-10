<?php

namespace Podzamenu\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ElementController extends Controller 
{
    public function menuAction()
    {
        if($this->get('security.context')->getToken())
        {
            if($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY'))
            {
                $user = $this->get('security.context')->getToken()->getUser();
                $user_name = $user->getUsername();

                return $this->render('PodzamenuMainBundle:Main:menu.html.twig', array(
                    'user_name' => $user_name,
                ));
            }
            else
            {
                return $this->render('PodzamenuMainBundle:Main:menu.html.twig', array(
                    'user_name' => null,
                ));
            }
        }
    }
}