<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use App\Repository\AgenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;



class AdresseController extends AbstractController
{
    #[Route('/adresse', name: 'app_adresse')]
    public function index(): Response
    {
        return $this->render('adresse/index.html.twig', [
            'controller_name' => 'AdresseController',
        ]);
    }

    #[Route('/adresse/afficherAdresse', name: 'affichess')]
    public function  afficher_adresses(AdresseRepository $repository): Response
    {
        $agence=$repository->findAll();
       //
        return  $this->render('adresse/afficheAdresse.html.twig', ['adresse'=>$agence]);
    }



    #[Route('/DeleteAdresse/{id}', name: 'dd')]
    function Delete($id, AdresseRepository $repository): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $adresse=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($adresse);
        $em->flush();
        return $this->redirectToRoute( 'affichess');
    }
    #[Route('/Adresse/Adds', name: 'ajouterss')]
    function add(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $adresse= new Adresse();
        $form=$this->createForm(AdresseType::class,$adresse);
        $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($adresse);
            $em->flush();
            return $this->redirectToRoute('affichess');
        }
        return $this->render('adresse/addAdresse.html.twig', ['form'=>$form->createView()]);
    }
    #[Route('/Adresse/Updates/{id}', name: 'updatee')]
    function Update(AdresseRepository $repository,$id,\Symfony\Component\HttpFoundation\Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $adresse=$repository->find($id);
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('affichess');
        }
        return $this->render('adresse/updateAdresse.html.twig', ['f' => $form->createView()]);


    }

    //AFFICHAGE DES ADRESSES FRONT

    #[Route('/adresseAgen/{id}', name: 'adresseAg')]
    public function  adresseAgences($id, AgenceRepository $repository): Response
    {
        $adressesAgence= $this->getDoctrine()->getRepository(Adresse::class)->findBy(['id_Agence'=>$id]);
        return $this->render('adresse/AfficheAdresseAgence.html.twig',['adresse'=> $adressesAgence]);

    }
    #[Route('/Agence/RechercheAdresse/n', name: 'Radresse')]
    function Recherchee(AdresseRepository $repository,Request $request): Response
    {
        $data=$request->get('search');
        $agence=$repository->findBy(['codePostal'=>$data]);
        return $this->render('adresse/afficheAdresse.html.twig', ['adresse'=>$agence]);
    }
}
