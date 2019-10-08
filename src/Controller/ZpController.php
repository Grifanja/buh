<?php

namespace App\Controller;

use App\Entity\Zp;
use App\Form\Elements\NaviItem;
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

//['Home'=>'/','Zp'=>'/zp','Esv'=>'/esv']

class ZpController extends AbstractController
{
    /**
     * @Route("/zp", name="zp_list")
     */
    public function index()
    {
        $zps       = $this->getDoctrine()->getRepository(Zp::class)->findAll();
        $naviItems = NaviItemList::setList(['Home'=>'/','Esv'=>'/esv','add'=>'/zp/new']);

        return $this->render('zp/index.html.twig',['zps'=>$zps,'naviItems'=>$naviItems]);
    }

    /**
     * @Route("/zp/new", name="new_zp", methods={"GET","POST"})
     * @throws \Exception
     */
    public function new(Request $request)
    {

        $zp = new Zp();

        $form = $this->createFormBuilder($zp)
            ->add('data_pay',DateType::class)
            ->add('sum',IntegerType ::class,['attr'=>['class'=>'form-control']])
            ->add('note',TextareaType::class,['required'=>false,'empty_data' =>'','attr'=>['class'=>'form-control']])
            ->add('save',SubmitType::class,['label'=>'Create','attr'=>['class'=>'btn btn-primary mt-3']])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $zp = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($zp);
            $entityManager->flush();

            return $this->redirectToRoute('zp_list');

        }

        return $this->render('zp/new.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/zp/edit/{id}", name="edit_zp", methods={"GET","POST"})
     * @throws \Exception
     */
    public function editCustomer(Request $request,$id)
    {

        $zp = $this->getDoctrine()->getRepository(zp::class)->find($id);

        $form = $this->createFormBuilder($zp)
            ->add('data_pay',DateType::class)
            ->add('sum',IntegerType ::class,['attr'=>['class'=>'form-control']])
            ->add('note',TextareaType::class,['required'=>false,'attr'=>['class'=>'form-control']])
            ->add('save',SubmitType::class,['label'=>'Create','attr'=>['class'=>'btn btn-primary mt-3']])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('zp_list');

        }

        return $this->render('zp/edit.html.twig',    ['form' => $form->createView()]);

    }

    /**
     * @Route("/zp/{id}", name="zp_show",methods={"GET"})
     */
    public function show($id)
    {
        $zp = $this->getDoctrine()->getRepository(zp::class)->find($id);
        return $this->render('zp/show.html.twig',['zp'=>$zp]);

    }

    /**
     * @Route("/zp/delete/{id}",methods={"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $zp = $this->getDoctrine()->getRepository(zp::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($zp);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

    public function save()
    {
        $em   = $this->getDoctrine()->getManager();
        $zp = new Zp();
        $zp->setTitle('zp two');
        $zp->setBody('this is the body for zp two');

        $em->persist($zp);
        $em->flush();

        return new Response("save a zp with the id of {$zp->getId()}");

    }


}
