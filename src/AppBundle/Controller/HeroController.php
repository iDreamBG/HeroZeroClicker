<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Baron;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeroController extends Controller
{
    /**
     * @Route("create/hero", name="count")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function clickerAction(Request $request)
    {
        $userId = $this->getUser()->getId();
        $currentUser =  $this->getDoctrine()
                             ->getRepository(User::class)
                             ->find($userId);

       $baronId = $currentUser->getBaron();
       $baron = $this->getDoctrine()
                     ->getRepository(Baron::class)
                     ->find($baronId);

       $baronBooster = $baron->getBooster();

        $currentUser->addMoney($baronBooster);

        $em = $this->getDoctrine()->getManager();
        $em->persist($currentUser);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("add/baron/{money}", name="add_baron")
     * @param $money
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addBaron($money){


        if($money >= 10){

            $userId = $this->getUser()->getId();
            $currentUser =  $this->getDoctrine()
                ->getRepository(User::class)
                ->find($userId);

            if($currentUser->getBaron()){

                $baronId = $currentUser->getBaron();
                $oldBaron = $this->getDoctrine()
                                 ->getRepository(Baron::class)
                                 ->find($baronId);

                $m = $currentUser->getMoney() - 10;
                $currentUser->setMoney($m);

                $oldBaron->setBooster($oldBaron->getBooster() + 0.5);
                $oldBaron->setLevel($oldBaron->getLevel() + 1);
                $em = $this->getDoctrine()->getManager();
                $em->persist($oldBaron);
                $em->persist($currentUser);
                $em->flush();

                return $this->redirectToRoute('homepage');

            }
            else {


                $baron = new Baron();

                $m = $currentUser->getMoney() - 10;
                $currentUser->setMoney($m);
                $currentUser->setBaron($baron);

                $baron->setBooster(0.5);
                $baron->setLevel(1);


                $em = $this->getDoctrine()->getManager();
                $em->persist($baron);
                $em->persist($currentUser);
                $em->flush();

                return $this->redirectToRoute('homepage');
            }
        }
        else{
            return $this->redirectToRoute('homepage');
        }
    }
}
