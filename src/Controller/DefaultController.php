<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Form\SearchType;
use App\Repository\AgenceRepository;
use App\Services\QrcodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class DefaultController extends AbstractController
{
    /**
     * @param Request $request
     * @param QrcodeService $qrcodeService
     * @return Response
     */

    #[Route('/default', name: 'app_default')]
    public function index(Request $request, QrcodeService $qrcodeService): Response
    {
        $qrCode = null;
        $form= $this->createForm(SearchType::class, data:null);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            // get the data research place

            $data =$form->getData();

            //appeler la fonction qui fait la création du QrCode appeler add avec name
            $qrCode=$qrcodeService->qrcode($data['name']);
        }
        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'qrCode'=>$qrCode
        ]);

    }
      #[Route('/defaultAfficher', name: 'app_default_afficher')]
      public function afficherContact(Request $request, QrcodeService $qrcodeService, AgenceRepository $repository): Response
      {
          return $this->render('default/test.html.twig');

      }
    #[Route('/hh', name: 'b')]
    public function hh(Request $request, QrcodeService $qrcodeService, AgenceRepository $repository): Response
    {
        $qrCode = null;
        $form= $this->createForm(SearchType::Class, data:null);
        $form->handleRequest($request);
        $data =$form->getData();
        return $this->render('default/test.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
