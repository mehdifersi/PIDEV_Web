<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\ContratType;
use App\Service\PdfService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/contrat')]
class ContratController extends AbstractController
{
    #[Route('/', name: 'app_contrat_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $contrats = $entityManager
            ->getRepository(Contrat::class)
            ->findAll();

        return $this->render('contrat/index.html.twig', [
            'contrats' => $contrats,
        ]);
    }



    #[Route('/tmp2/{id}', name: 'app_contrat_dompdf', methods: ['GET'])]
    public function contratdompdf(Contrat $contrat,Request $request, EntityManagerInterface $entityManager):Response

    {
        if ($this->isCsrfTokenValid('delete2'.$contrat->getId(), $request->request->get('_token2')))
        {
            $html = $this->renderView('contrat/mypdf.html.twig', ['contrat'=>$contrat]);}
            $pdfOptions = new Options();
            $pdfOptions->set('defaultFont', 'Arial');

            // Instantiate Dompdf with our options
            $dompdf = new Dompdf($pdfOptions);

            // Retrieve the HTML generated in our twig file
            $html = $this->renderView('contrat/mypdf.html.twig', ['contrat'=>$contrat]);

            // Load HTML to Dompdf
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();
            $a = "contrat";
            $a = $a . $contrat->getReference();
            // Output the generated PDF to Browser (force download)
            $dompdf->stream($a, [
                "Attachment" => true
            ]);
            return  new Response();
    }
    #[Route('/new', name: 'app_contrat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contrat = new Contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);
        $ref=$this->generateRef();
        $contrats = $entityManager
            ->getRepository(Contrat::class)->findBy(['reference' => $ref]);
        while(count($contrats)!=0)
        {
            $ref=$this->generateRef();
            $contrats = $entityManager
                ->getRepository(Contrat::class)->findBy(['reference' => $ref]);
        }
        $contrat->setReference($ref);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contrat);
            $entityManager->flush();

            return $this->redirectToRoute('app_contrat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contrat/new.html.twig', [
            'contrat' => $contrat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contrat_show', methods: ['GET'])]
    public function show(Contrat $contrat): Response
    {
        return $this->render('contrat/show.html.twig', [
            'contrat' => $contrat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contrat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contrat $contrat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_contrat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contrat/edit.html.twig', [
            'contrat' => $contrat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contrat_delete', methods: ['POST'])]
    public function delete(Request $request, Contrat $contrat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contrat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contrat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_contrat_index', [], Response::HTTP_SEE_OTHER);
    }
    public function generateRef():string{
        $ref="RF-";
        for ($x = 0; $x < 8; $x++) {
            $tmp=strval(rand(0,9));
            $ref= $ref . $tmp;
        }
        return $ref;

    }
    #[Route('/RechercheBien/', name: 'recherchecontrat')]
    function Recherche(EntityManagerInterface $entityManager,Request $request): Response
    {
        $data=$request->get('search');
        $bien=$entityManager->getRepository(Contrat::class)->findBy(['reference'=>$data]);

        return $this->render('contrat/index.html.twig', ['contrats'=>$bien]);
    }
    #[Route('/tmp/{id}', name: 'app_contrat_front')]
    public function contratfront($id,Request $request, EntityManagerInterface $entityManager): Response
    {

        $contrats = $entityManager
            ->getRepository(Contrat::class)->findBy(['client' => $id]);
        return $this->render('tmp/index.html.twig', ['contrats'=>$contrats]);
    }


}
