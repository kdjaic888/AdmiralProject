<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\GameMachines;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class GameMachinesController extends AbstractController
{
    /**
     * @Route("/game/machines", name="game_machines")
     */
    public function index()
    {
        $gamemachines=$this->getDoctrine()->getRepository(GameMachines::class)->findAll();
        return $this->render('machines/machines.html.twig',array('gamemachines'=>$gamemachines));
    }

    /**
     * @Route("/game/machines/create", name="create_game_machines")
     */
    public function Createindex(Request $request)
    {
        $game=new GameMachines;
        $form=$this->createFormBuilder($game)
        ->add('name', TextType::Class, array('label'=> 'Ime','attr'=>array('class'=>'form-control', 'style'=>'margin-top:10px')))
        ->add('serial_number', IntegerType::Class, array('label'=> 'Serijski broj','attr'=>array('class'=>'form-control', 'style'=>'margin-top:10px')))
        ->add('end_of_guarantee_date', DateType::Class, array('label'=> 'Garancija','attr'=>array('class'=>'form-control', 'style'=>'margin-top:10px')))
        ->add('game_type_id', TextareaType::Class, array('label'=> 'Vrsta igre','attr'=>array('class'=>'form-control', 'style'=>'margin-top:10px')))
        ->add('save', SubmitType::Class, array('label'=> 'Kreiraj automat', 'attr'=>array('class'=>'btn btn-primary', 'style'=>'margin-top:10px')))
        ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $name= $form['name']->getData();
            $serial_number= $form['serial_number']->getData();
            $end_of_guarantee_date= $form['end_of_guarantee_date']->getData();
            $game_type_id= $form['game_type_id']->getData();

            $game->setName($name);
            $game->setSerialNumber($serial_number);
            $game->setEndOfGuaranteeDate($end_of_guarantee_date);
            $game->setGameTypeId($game_type_id);

            $em=$this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
            $this->addFlash('message', 'Automat je dodan uspjesno');

            return $this->redirectToRoute('game_machines');

        }
        return $this->render('machines/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/game/machines/view/{id}", name="view_game_machines")
     */
    public function Viewindex($id, Request $request)
    {
        $prikaz=$this->getDoctrine()->getRepository(GameMachines::class)->find($id);
        return $this->render('machines/view.html.twig',['prikaz' => $prikaz]);
    }

    /**
     * @Route("/game/machines/delete/{id}", name="delete_game_machines")
     */
    public function Deleteindex($id)
    {
        $em=$this->getDoctrine()->getManager();
        $post=$em->getRepository('App:GameMachines')->find($id);
        $em->remove($post);

        $em->flush();
        $this->addFlash('message', 'Automat je obrisan uspjesno');

        return $this->redirectToRoute('game_machines');
    }
}
