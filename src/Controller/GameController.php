<?php

namespace App\Controller;

use App\Entity\Esv;
use App\Entity\Zp;
use App\Form\Elements\NaviItemList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function index()
    {
        $zps       = $this->getDoctrine()->getRepository(Zp::class)->findAll();
        $esvs      = $this->getDoctrine()->getRepository(Esv::class)->findAll();
        $naviItems = NaviItemList::setList(['Zp'=>'/zp','Esv'=>'/esv','Game'=>'/game']);
        $data      = ['zps'=>$zps,'esvs'=>$esvs,'naviItems'=>$naviItems];

        return $this->render('game/index.html.twig',$data);
    }



}
