<?php
namespace Podzamenu\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;

class MainController extends Controller
{
    public function profileAction($data)
    {
        $users = $this->getDoctrine()
            ->getRepository('PodzamenuMainBundle:Users')
            ->find($data);

        $posts = null;
        if(count($users) > 0 && $users->getPublic() == 1)
        {
            $repository = $this->getDoctrine()
                ->getRepository('PodzamenuMainBundle:Posts');
            $query = $repository->createQueryBuilder('p')
                ->where('p.idUser = :idUser')
                ->setParameter('idUser', $users->getId())
                ->orderBy('p.id', 'DESC')
                ->getQuery();
            $posts = $query->getResult();
        }

        return $this->render('PodzamenuMainBundle:Main:profile.html.twig', array(
            'users' => $users,
            'posts' => $posts,
        ));
    }
    
    public function searchAction(Request $request)
    {
        $search = trim($request->request->get('search_text'));

        $repository = $this->getDoctrine()
            ->getRepository('PodzamenuMainBundle:Users');
        $query = $repository->createQueryBuilder('p')
            ->where('p.username LIKE :username')
            ->setParameter('username', "%".$search."%")
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(3)
            ->getQuery();
        $users = $query->getResult();

        $repository = $this->getDoctrine()
            ->getRepository('PodzamenuMainBundle:Posts');
        foreach($users as $key => $value)
        {
            $query = $repository->createQueryBuilder('p')
                ->where('p.idUser = :idUser')
                ->setParameter('idUser', $value->getId())
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(3)
                ->getQuery();
            $users[$key]->posts = $query->getResult();
        }

        return $this->render('PodzamenuMainBundle:Main:start_page.html.twig', array(
            'search' => $search,
            'users' => $users,
        ));
    }

    public function start_pageAction()
    {
        return $this->render('PodzamenuMainBundle:Main:start_page.html.twig');
    }
}
