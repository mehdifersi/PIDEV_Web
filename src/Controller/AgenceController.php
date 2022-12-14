<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Agence;
use App\Entity\Rating;
use App\Repository\AdresseRepository;
use App\Repository\AgenceRepository;
use App\Services\QrcodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AgenceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class AgenceController extends AbstractController
{
    #[Route('/agence', name: 'app_agence')]
    public function index(): Response
    {
        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
        ]);
    }
    #[Route('/afficherAgence', name: 'affiches')]
    public function  Afficher(AgenceRepository $repository): Response
    {
        $agence=$repository->findAll();
        return $this->render('agence/afficheAgence.html.twig', ['agence'=>$agence]);
    }

    #[Route('/DeleteAgence/{id}', name: 'd')]
    function Delete($id, AgenceRepository $repository): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $agence=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($agence);
        $em->flush();
        return $this->redirectToRoute( 'affiches');
    }
    #[Route('/agence/Adds', name: 'ajouters')]
    function add(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $agence= new Agence();
        $form=$this->createForm(AgenceType::class,$agence);
        $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($agence);
            $em->flush();
            return $this->redirectToRoute('affiches');
        }
        return $this->render('agence/addAgence.html.twig', ['form'=>$form->createView()]);
    }
    #[Route('/agence/Updates/{id}', name: 'update')]
    function Update(AgenceRepository $repository,$id,\Symfony\Component\HttpFoundation\Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $agence = $repository->find($id);
        $form = $this->createForm(AgenceType::class, $agence);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('affiches');
        }
        return $this->render('agence/updateAgence.html.twig', ['f' => $form->createView()]);

    }

    #[Route('/Agence/RechercheAgence/', name: 'rechercheAgence')]
    function Recherche(AgenceRepository $repository,Request $request): Response
    {
        $data=$request->get('search');
        $agence=$repository->findBy(['region'=>$data]);
        return $this->render('agence/afficheAgence.html.twig', ['agence'=>$agence]);
    }

    #[Route('/afficherAgencefront', name: 'affichesfront')]
    public function  Afficherfront(AgenceRepository $repository): Response
    {
        $agence=$repository->findAll();
        return $this->render('/frontAgence.html.twig', ['agence'=>$agence]);
    }
    #[Route('/Agence/RechercheAgence/n', name: 'rechercheAgencefront')]
    function Recherchee(AgenceRepository $repository,Request $request): Response
    {
        $data=$request->get('search');
        $agence=$repository->findBy(['region'=>$data]);
        return $this->render('default/test.html.twig', ['agence'=>$agence]);
    }

    #[Route('/afficherAgenceQR', name: 'affichesQR')]
    public function  AfficherQr(AgenceRepository $repository): Response
    {
        $agence=$repository->findAll();
        return $this->render('default/test.html.twig', ['agence'=>$agence]);

    }
    #[Route('/hh/{id}', name: 'bb')]
    public function  hh($id, AgenceRepository $repository,QrcodeService $qrcodeService): Response
    {
        $agence=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $l=$em->find('App\Entity\Agence',$id);
        $qrCode=$qrcodeService->qrcode($l->getWebsite());
        return $this->render('default/index.html.twig', [
            'qrCode'=>$qrCode ]);

    }

    #[Route('/Rating/{id}', name: 'rate')]
    public function RatingByRegion($id , AgenceRepository $repository ): Response

    {
        $rate=$repository->findOneBy(['id'=>$id]);
        $list= $this->getDoctrine()->getRepository(Rating::class)->findAll();
        $c=0;
        $s=0;
        //dd($rate);
        //dd($list[0]->getRegion()->getId());
        for ($i=0; $i<count($list);$i++)
        {
            if ($rate->getId()==$list[$i]->getRegion()->getId())
            {
                $c=$c+1;
                $s=$s+$list[$i]->getRatingScore();
            }
        }
        $a=$s/$c;


        return $this->render('rating/Rating.html.twig',['rate'=> $a]);
    }



}
