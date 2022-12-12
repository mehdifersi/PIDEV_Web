<?php

namespace App\Controller;

use App\Entity\Rating;
use App\Form\RatingType;
use App\Repository\RatingRepository;
use http\Env\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatingController extends AbstractController
{
    #[Route('/rating', name: 'app_rating')]
    public function index(): Response
    {
        return $this->render('rating/Rating.html.twig', [
            'controller_name' => 'RatingController',
        ]);
    }


    //AFFICHER RATING

    #[Route('/afficherRating', name: 'affichesRating')]
    public function  Afficher(RatingRepository $repository): Response

    {
        $rate=$repository->findAll();
        return $this->render('rating/Rating.html.twig', ['rating'=>$rate]);
    }
     //DELETE Rating fonction

    #[Route('/DeleteRating/{id}', name: 'deleteRating')]
    function Delete($id, RatingRepository $repository): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $rating=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($rating);
        $em->flush();
        return $this->redirectToRoute( 'affichesRating');
    }

    //fonction controle saisie



    //ADD Rating fonction

    #[Route('/AddRating', name: 'ajouterRating')]
    function add(\Symfony\Component\HttpFoundation\Request $request , FlashyNotifier $flashy): Response
    {
        $rate= new Rating();
        $form=$this->createForm(RatingType::class,$rate);
       // $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($rate);
            $flashy->primaryDark('  Merci pour votre confiance à notre service!  ');
            //return $this->redirectToRoute('affichesRating');
        }
        return $this->render('rating/addRating.html.twig', ['form'=>$form->createView()]);
    }

    //Update
    #[Route('/Updates/{id}', name: 'updateRating')]
    function Update(AgenceRepository $repository,$id,\Symfony\Component\HttpFoundation\Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $rate = $repository->find($id);
        $form = $this->createForm(RatingType::class, $rate);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('affiches');
        }
        return $this->render('agence/updateAgence.html.twig', ['f' => $form->createView()]);

    }


}
