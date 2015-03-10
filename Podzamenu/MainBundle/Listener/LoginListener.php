<?php
namespace Podzamenu\MainBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Bundle\DoctrineBundle\Registry as Doctrine;

class LoginListener
{
    protected $doctrine;

    public function __construct(Doctrine $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function onLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        if($user)
        {
            $user->setCountLogin($user->getCountLogin()+1);
            $em = $this->doctrine->getEntityManager();
            $em->flush();
        }
    }
}