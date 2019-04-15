<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Baron;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('user_enter');
        } else {
            return $this->render("default/index.html.twig");
        }
    }

    /**
     * @Route("home", name="user_enter")
     */
    public function homeAction()
    {
        $userId = $this->getUser()->getId();

        $user = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->find($userId);


        return $this->render('clicker/home.html.twig',
            [
                'user' => $user,
            ]);
    }

    /**
     * @Route("ranklist", name="ranklist")o
     */
    public function ranklistAction(){

       $users = $this->getDoctrine()->getRepository(User::class)->findAll();
       $barons = $this->getDoctrine()->getRepository(Baron::class)->findAll();
        return $this->render('clicker/ranklist.html.twig',
            [
                'users' => $users,
                'barons' =>$barons
            ]);
    }

}
