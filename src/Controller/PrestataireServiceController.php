<?php

namespace App\Controller;

use App\Entity\PrestataireService;
use App\Form\PrestataireServiceType;
use App\Repository\PrestataireServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prestataire/service')]
class PrestataireServiceController extends AbstractController
{
    #[Route('/', name: 'app_prestataire_service_index', methods: ['GET'])]
    public function index(PrestataireServiceRepository $prestataireServiceRepository): Response
    {
        return $this->render('prestataire_service/index.html.twig', [
            'prestataire_services' => $prestataireServiceRepository->findAll(),
        ]);
    }
    #[Route('/AffichePrestataireServicefront', name: 'affiche_prestataireService_front')]
    public function  Afficherfront(PrestataireServiceRepository $repository): Response
    {
        $prestataireService=$repository->findAll();
        return $this->render('prestataire_service/AffichePrestataireServicefront.html.twig', ['prestataireService'=>$prestataireService]);
    }
    #[Route('/new', name: 'app_prestataire_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PrestataireServiceRepository $prestataireServiceRepository, EntityManagerInterface $entityManager): Response
    {
        $prestataireService = new PrestataireService();
        $form = $this->createForm(PrestataireServiceType::class, $prestataireService);
        $form->handleRequest($request);
        $ref=$this->generateRef();
        $prestataireServices = $entityManager
            ->getRepository(PrestataireService::class)->findBy(['ref' => $ref]);

        while(count($prestataireServices)!=0)
        {
            $ref=$this->generateRef();
            $prestataireServices = $entityManager
                ->getRepository(PrestataireService::class)->findBy(['ref' => $ref]);

        }
    $prestataireService->setRef($ref);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prestataireService);
            $entityManager->flush();
            return $this->redirectToRoute('app_prestataire_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prestataire_service/new.html.twig', [
            'prestataire_service' => $prestataireService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prestataire_service_show', methods: ['GET'])]
    public function show(PrestataireService $prestataireService): Response
    {
        return $this->render('prestataire_service/show.html.twig', [
            'prestataire_service' => $prestataireService,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_prestataire_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PrestataireService $prestataireService, PrestataireServiceRepository $prestataireServiceRepository): Response
    {
        $form = $this->createForm(PrestataireServiceType::class, $prestataireService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prestataireServiceRepository->save($prestataireService, true);

            return $this->redirectToRoute('app_prestataire_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prestataire_service/edit.html.twig', [
            'prestataire_service' => $prestataireService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prestataire_service_delete', methods: ['POST'])]
    public function delete(Request $request, PrestataireService $prestataireService, PrestataireServiceRepository $prestataireServiceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prestataireService->getId(), $request->request->get('_token'))) {
            $prestataireServiceRepository->remove($prestataireService, true);
        }

        return $this->redirectToRoute('app_prestataire_service_index', [], Response::HTTP_SEE_OTHER);
    }
    public function generateRef():string{
        $ref="RF-";
        for ($x = 0; $x < 8; $x++) {
            $tmp=strval(rand(0,9));
            $ref= $ref . $tmp;
        }
        return $ref;

    }


    #[Route('/DeletePrestataireServicefront/{id}', name: 'deletefront')]
    function Deletefront($id, PrestataireServiceRepository $repository): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $prestataireService=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($prestataireService);
        $em->flush();

        return $this->redirectToRoute( 'affiche_prestataireService_front');
    }
    #[Route('/tmp3', name : 'sflkjfkls')]
    public function paginatoor(PaginatorInterface $paginator, EntityManagerInterface $entityManager, Request $request):Response{

        $donnees = $entityManager->getRepository(PrestataireService::class)->findAll();
        $prestataires = $paginator->paginate($donnees);


        return $this->render('prestataire_service/paginator.html.twig',['donnees'=>$prestataires]);
    }



}
