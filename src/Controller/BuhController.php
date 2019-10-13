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

class BuhController extends AbstractController
{
    /**
     * @Route("/", name="buh")
     */
    public function index()
    {
        $zps    = $this->getDoctrine()->getRepository(Zp::class)->findAll();
        $arrzp  = [];
        $sum_zp = [];


        foreach ($zps as $zp){
            $year = $zp->getDataPay()->format("Y");
            if(!isset($sum_zp[$year])){$sum_zp[$year] = 0;}
            $sum_zp[$year] += $zp->getSum();
        }
        dump($arrzp);
        dump($sum_zp);
        $esvs      = $this->getDoctrine()->getRepository(Esv::class)->findAll();
        $naviItems = NaviItemList::setList(['Zp'=>'/zp','Esv'=>'/esv','Game'=>'/game']);
        $data      = ['zps'=>$zps,'esvs'=>$esvs,'naviItems'=>$naviItems,'sum_zp'=>$sum_zp];

        return $this->render('buh/index.html.twig',$data);
    }





}
