<?php

namespace Podzamenu\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Podzamenu\MainBundle\Model\UsefullModel;
use Podzamenu\MainBundle\Entity\Users;
use Podzamenu\MainBundle\Entity\CheckEmail;

class SecurityController extends Controller
{
    public function confirm_emailAction($data)
    {
        $repository = $this->getDoctrine()
            ->getRepository('PodzamenuMainBundle:CheckEmail');

        $query = $repository->createQueryBuilder('p')
            ->where('p.href = :hrefe')
            ->setParameter('href', $data)
            ->getQuery();

        $CheckEmail = $query->getResult();

        $status = "error";
        if(count($CheckEmail) > 0 && $CheckEmail->getDateEnd() > time())
        {
            $Users = $this->getDoctrine()
                ->getRepository('PodzamenuMainBundle:Users')
                ->find($CheckEmail->getIdUser());
            $Users->setStatus(1);

            $em = $this->getDoctrine()->getEntityManager();
            $em->flush();

            $status = "ok";
        }

        return $this->render('PodzamenuMainBundle:Main:confirm_email.html.twig', array(
            'status' => $status,
        ));
    }

    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        else
        {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('PodzamenuMainBundle:Security:login.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error
        ));
    }

    //регистрация нового пользователя
    public function registrationAction(Request $request, $data)
    {
        $conn = $this->get('database_connection');

        if($data == "none")
        {
            return $this->render('PodzamenuMainBundle:Security:registration.html.twig', array(
                'status' => "none"
            ));
        }
        else
        {
            $status = "error";
            $username = trim($request->request->get('username'));
            $password = trim($request->request->get('password'));
            $email = trim($request->request->get('email'));

            $repository = $this->getDoctrine()
                ->getRepository('PodzamenuMainBundle:Users');

            $query = $repository->createQueryBuilder('p')
                ->where('p.username = :username')
                ->setParameter('username', $username)
                ->getQuery();

            $users = $query->getResult();

            $check_data = 0;
            if(strlen($password) > 0
                && strlen($username) > 0
                && strlen($email) > 0
                && count($users) == 0)
            {
                {
                    $check_data = 1;
                }
            }

            if($check_data == 1)
            {
                $factory = $this->get('security.encoder_factory');

                $user = new Users();
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($password, $user->getSalt());

                $user->setStatus(0);
                $user->setUsername($username);
                $user->setPassword($password);

                $entity_manager = $this->getDoctrine()->getEntityManager();
                $entity_manager->persist($user);
                $entity_manager->flush();


                $hash = sha1(uniqid(true));
                $usefull = new UsefullModel();
                $usefull->check_email($email, $hash);

                $CheckEmail = new CheckEmail();
                $CheckEmail->setIdUser($user->getId());
                $CheckEmail->setDateEnd(time()+3600);
                $CheckEmail->setHref($hash);

                $entity_manager->persist($CheckEmail);
                $entity_manager->flush();

                $status = "ok";
            }

            return $this->render('PodzamenuMainBundle:Security:registration.html.twig', array(
                'status' => $status
            ));
        }
    }
}
