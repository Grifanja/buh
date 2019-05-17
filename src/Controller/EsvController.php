<?php
/**
 * Created by PhpStorm.
 * User: diandol
 * Date: 20.02.2019
 * Time: 8:27
 */

namespace App\Controller;


namespace App\Controller;

use App\Entity\Esv;
use App\Form\Elements\NaviItemList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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

class EsvController extends AbstractController
{
    /**
     * @Route("/esv", name="esv_list")
     */
    public function index()
    {
        $esvs      = $this->getDoctrine()->getRepository(Esv::class)->findAll();
        $naviItems = NaviItemList::setList(['Home'=>'/','Zp'=>'/zp','add'=>'/esv/new']);

        return $this->render('esv/index.html.twig',['esvs'=>$esvs,'naviItems'=>$naviItems]);
    }

    /**
     * @Route("/esv/new", name="new_esv", methods={"GET","POST"})
     * @throws \Exception
     */
    public function new(Request $request)
    {

        $esv  = new Esv();
        $year = [ '2018' => '2018' , '2019' => '2019', '2020' => '2020' ];

        $form = $this->createFormBuilder($esv)
            ->add('year',ChoiceType::class, ['choices'  => $year])
            ->add('sum',IntegerType ::class,['attr'=>['class'=>'form-control']])
            ->add('save',SubmitType::class,['label'=>'Create','attr'=>['class'=>'btn btn-primary mt-3']])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $esv = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($esv);
            $entityManager->flush();

            return $this->redirectToRoute('esv_list');

        }

        return $this->render('esv/new.html.twig',    ['form' => $form->createView()]);

    }

    /**
     * @Route("/esv/edit/{id}", name="edit_esv", methods={"GET","POST"})
     * @throws \Exception
     */
    public function edit(Request $request,$id)
    {

        $esv  = $this->getDoctrine()->getRepository(esv::class)->find($id);
        $year = [ '2018' => '2018' , '2019' => '2019', '2020' => '2020' ];

        $form = $this->createFormBuilder($esv)
            ->add('year',ChoiceType::class, ['choices'  => $year])
            ->add('sum',IntegerType ::class,['attr'=>['class'=>'form-control']])
            ->add('save',SubmitType::class,['label'=>'Save','attr'=>['class'=>'btn btn-primary mt-3']])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('esv_list');

        }

        return $this->render('esv/edit.html.twig',    ['form' => $form->createView()]);

    }

    /**
     * @Route("/esv/{id}", name="esv_show",methods={"GET"})
     */
    public function show($id)
    {
        $esv = $this->getDoctrine()->getRepository(esv::class)->find($id);
        return $this->render('esv/show.html.twig',['esv'=>$esv]);

    }

    /**
     * @Route("/esv/delete/{id}",methods={"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $esv = $this->getDoctrine()->getRepository(esv::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($esv);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

    public function save()
    {
        $em   = $this->getDoctrine()->getManager();
        $esv = new Esv();
        $esv->setTitle('esv two');
        $esv->setBody('this is the body for esv two');

        $em->persist($esv);
        $em->flush();

        return new Response("save a esv with the id of {$esv->getId()}");

    }


}
