<?php

namespace App\Controller;

use App\Entity\EtatBiens;
use App\Form\EtatBiensType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etat/biens')]
class EtatBiensController extends AbstractController
{
    #[Route('/', name: 'app_etat_biens_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $etatBiens = $entityManager
            ->getRepository(EtatBiens::class)
            ->findAll();

        return $this->render('etat_biens/index.html.twig', [
            'etat_biens' => $etatBiens,
        ]);
    }

    #[Route('/new', name: 'app_etat_biens_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etatBien = new EtatBiens();
        $form = $this->createForm(EtatBiensType::class, $etatBien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etatBien);
            $entityManager->flush();

            return $this->redirectToRoute('app_etat_biens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etat_biens/new.html.twig', [
            'etat_bien' => $etatBien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etat_biens_show', methods: ['GET'])]
    public function show(EtatBiens $etatBien): Response
    {
        return $this->render('etat_biens/show.html.twig', [
            'contrat' => $etatBien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etat_biens_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EtatBiens $etatBien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtatBiensType::class, $etatBien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_etat_biens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etat_biens/edit.html.twig', [
            'contrat' => $etatBien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etat_biens_delete', methods: ['POST'])]
    public function delete(Request $request, EtatBiens $etatBien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etatBien->getId(), $request->request->get('_token'))) {
            $entityManager->remove($etatBien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_etat_biens_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/RechercheBien/', name: 'rechercheetatbiens')]
    function Recherche(EntityManagerInterface $entityManager,Request $request): Response
    {
        $data=$request->get('search');
        $bien=$entityManager->getRepository(EtatBiens::class)->findBy(['id'=>$data]);

        return $this->render('etat_biens/index.html.twig', ['etat_biens'=>$bien]);
    }
}
