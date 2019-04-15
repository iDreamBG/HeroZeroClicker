<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Baron;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $baron = new Baron();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());

            $user->setBaron($baron);
            $baron->setBooster(0.0);
            $baron->setLevel(0);

            $user->setPassword($password);
            $user->setMoney(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($baron);
            $em->flush();

            return $this->redirectToRoute("security_login");

        }
        
        return $this->render('user/register.html.twig',
            ['form' => $form->createView()]
        );
    }
}
