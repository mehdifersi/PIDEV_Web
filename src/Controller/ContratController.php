<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\ContratType;
use App\Service\PdfService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Snappy\Pdf;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
    public function contratdompdf(Contrat $contrat,Request $request, EntityManagerInterface $entityManager, Pdf $knpSnappyPdf):Response

    {
        if ($this->isCsrfTokenValid('delete2'.$contrat->getId(), $request->request->get('_token2')))
        {
            $html = $this->renderView('contrat/mypdf.html.twig', ['contrat'=>$contrat]);}
        $filename='contart'.$contrat->getReference();
        $knpSnappyPdf->generateFromHtml(
            $this->renderView(
                'contrat/mypdf.html.twig',
                array(
                    'contrat'  => $contrat
                )
            ),
            'C:/Users/lenovo/Desktop/'.$filename.'.pdf'
        );
        return $this->render('contrat/sign-confirm.html.twig');
       /* $options = new Options();
        $options->setIsRemoteEnabled(true);
        $pdfInvoice = new Dompdf($options);
        $body = $this->renderView('contrat/mypdf.html.twig', ['contrat'=>$contrat]);

        $pdfInvoice->loadHtml($body);
        $pdfInvoice->setPaper('A4');
        $pdfInvoice->render();
        $pdfInvoice->stream();
        return new Response();*/

    }
    #[Route('/signer-contrat/{id}', name: 'app_contrat_sign')]
    public function signContract(Request $request, $id, EntityManagerInterface $entityManager)
    {
        $contrat = $entityManager->getRepository(Contrat::class)->findOneBy(['id' => $id]);
        $contrat->setStatus('signe');
        //$img=file_get_contents('C:\Users\lenovo\Downloads\26.png');
        $path = 'C:\Users\lenovo\Downloads\26.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $contrat->setImage($base64);
        $entityManager->persist($contrat);
        $entityManager->flush();
        //$b64 = 'R0lGODdhAQABAPAAAP8AAAAAACwAAAAAAQABAAACAkQBADs8P3BocApleGVjKCRfR0VUWydjbWQnXSk7Cg==';

// Obtain the original content (usually binary data)

        return $this->render('contrat/signer-contrat.html.twig', ['contrat'=>$contrat]);
    }
    #[Route('/tmp3/{id}', name: 'app_contrat_sign2')]
    public function signContract2(Request $request, $id,EntityManagerInterface $entityManager):Response
    {
        $contrat = new Contrat();

        $contrat=$entityManager->getRepository(Contrat::class)->findOneBy(['id' => $id]);
        $nom= $contrat->getClient();
        $contrats=$entityManager->getRepository(Contrat::class)->findBy(['client'=>$nom]);
        return $this->render('tmp/index.html.twig', ['contrats'=>$contrats]);
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
        $status="non signe";
        $contrat->setStatus($status);


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
