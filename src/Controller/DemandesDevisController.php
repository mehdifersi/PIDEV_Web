<?php

namespace App\Controller;

use App\Entity\DemandesDevis;
use App\Form\DemandesDevisType;
use App\Repository\DemandesDevisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/demandes/devis')]
class DemandesDevisController extends AbstractController
{
    #[Route('/', name: 'app_demandes_devis_index', methods: ['GET'])]
    public function index(DemandesDevisRepository $demandesDevisRepository): Response
    {
        return $this->render('demandes_devis/index.html.twig', [
            'demandes_devis' => $demandesDevisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_demandes_devis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DemandesDevisRepository $demandesDevisRepository, EntityManagerInterface $entityManager): Response
    {
        $demandesDevi = new DemandesDevis();
        $form = $this->createForm(DemandesDevisType::class, $demandesDevi);
        $form->handleRequest($request);
        $ref=$this->generateRef();
        $demandesDevis = $entityManager
            ->getRepository(DemandesDevis::class)->findBy(['ref' => $ref]);

        while(count($demandesDevis)!=0)
        {
            $ref=$this->generateRef();
            $demandesDevis = $entityManager
                ->getRepository(DemandesDevis::class)->findBy(['ref' => $ref]);

        }
        $demandesDevi->setRef($ref);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($demandesDevi);
            $entityManager->flush();
            return $this->redirectToRoute('app_demandes_devis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demandes_devis/new.html.twig', [
            'demandes_devi' => $demandesDevi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demandes_devis_show', methods: ['GET'])]
    public function show(DemandesDevis $demandesDevi): Response
    {
        return $this->render('demandes_devis/show.html.twig', [
            'demandes_devi' => $demandesDevi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_demandes_devis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DemandesDevis $demandesDevi, DemandesDevisRepository $demandesDevisRepository): Response
    {
        $form = $this->createForm(DemandesDevisType::class, $demandesDevi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demandesDevisRepository->save($demandesDevi, true);

            return $this->redirectToRoute('app_demandes_devis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demandes_devis/edit.html.twig', [
            'demandes_devi' => $demandesDevi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demandes_devis_delete', methods: ['POST'])]
    public function delete(Request $request, DemandesDevis $demandesDevi, DemandesDevisRepository $demandesDevisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandesDevi->getId(), $request->request->get('_token'))) {
            $demandesDevisRepository->remove($demandesDevi, true);
        }

        return $this->redirectToRoute('app_demandes_devis_index', [], Response::HTTP_SEE_OTHER);
    }
    public function generateRef():string{
        $ref="RF-";
        for ($x = 0; $x < 8; $x++) {
            $tmp=strval(rand(0,9));
            $ref= $ref . $tmp;
        }
        return $ref;

    }
}
