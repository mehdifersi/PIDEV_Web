<?php

namespace App\Controller;

use App\Entity\DevisService;
use App\Form\DevisServiceType;
use App\Repository\DevisServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/devis/service')]
class DevisServiceController extends AbstractController
{
    #[Route('/', name: 'app_devis_service_index', methods: ['GET'])]
    public function index(DevisServiceRepository $devisServiceRepository): Response
    {
        return $this->render('devis_service/index.html.twig', [
            'devis_services' => $devisServiceRepository->findAll(),
        ]);
    }


    public function devisdompdf(DevisService $devis)

    {

            $html = $this->renderView('devis_service/mypdf.html.twig', ['devis'=>$devis]);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('devis_service/mypdf.html.twig', ['devis'=>$devis]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        $a = "devis";
        $a = $a . $devis->getRef();
        // Output the generated PDF to Browser (force download)
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory

        $pdfFilepath =  'C:/users/Gaming/Desktop/mypdf.pdf';

        // Write file to the desired path
        file_put_contents($pdfFilepath, $output);


    }

    #[Route('/new', name: 'app_devis_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DevisServiceRepository $devisServiceRepository, EntityManagerInterface $entityManager): Response
    {
        $devisService = new DevisService();
        $form = $this->createForm(DevisServiceType::class, $devisService);
        $form->handleRequest($request);
        $ref=$this->generateRef();
        $devisServices = $entityManager
            ->getRepository(DevisService::class)->findBy(['ref' => $ref]);

        while(count($devisServices)!=0)
        {
            $ref=$this->generateRef();
            $devisServices = $entityManager
                ->getRepository(DevisService::class)->findBy(['ref' => $ref]);

        }
        $devisService->setRef($ref);
        $devisService->setPrixTtc($devisService->getPrixHt()*1.2);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($devisService);
            $entityManager->flush();
            $this->devisdompdf($devisService);
            $mail = new PHPMailer(true);

            $mail->isSMTP();// Set mailer to use SMTP
            $mail->CharSet = "utf-8";// set charset to utf8
            $mail->SMTPAuth = true;// Enable SMTP authentication
            $mail->SMTPSecure = 'tls';// Enable TLS encryption, ssl also accepted

            $mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
            $mail->Port = 587;// TCP port to connect to
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isHTML(true);// Set email format to HTML

            $mail->Username = 'mahdi.fersi@esprit.tn';// SMTP username
            $mail->Password ='flatronsus';
            $mail->setFrom('mahdi.fersi@esprit.tn', 'Admin Viva_La_Villa');//Your application NAME and EMAIL
            $mail->Subject = 'Devis Service';//Message subject
            $mail->Body = '<h1>Votre demande de devis a etait traiter avec succées</h1>';// Message body
            $mail->AddAttachment('C:/users/Gaming/Desktop/mypdf.pdf');
            $mail->addAddress('midoufersi@gmail.com');// Target email


            $mail->send();

            return $this->redirectToRoute('app_devis_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_service/new.html.twig', [
            'devis_service' => $devisService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_service_show', methods: ['GET'])]
    public function show(DevisService $devisService): Response
    {
        return $this->render('devis_service/show.html.twig', [
            'devis_service' => $devisService,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_devis_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DevisService $devisService, DevisServiceRepository $devisServiceRepository): Response
    {
        $devisService = new DevisService();
        $form = $this->createForm(DevisServiceType::class, $devisService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisServiceRepository->save($devisService, true);

            return $this->redirectToRoute('app_devis_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_service/edit.html.twig', [
            'devis_service' => $devisService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_service_delete', methods: ['POST'])]
    public function delete(Request $request, DevisService $devisService, DevisServiceRepository $devisServiceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devisService->getId(), $request->request->get('_token'))) {
            $devisServiceRepository->remove($devisService, true);
        }

        return $this->redirectToRoute('app_devis_service_index', [], Response::HTTP_SEE_OTHER);
    }
    public function generateRef():string{
        $ref="RF-";
        for ($x = 0; $x < 8; $x++) {
            $tmp=strval(rand(0,9));
            $ref= $ref . $tmp;
        }
        return $ref;

    }
   #[Route('/tmp/{id}', name: 'app_devis_front')]
    public function devisfront($id,Request $request, EntityManagerInterface $entityManager): Response
    {

      $devis = $entityManager
            ->getRepository(DevisService::class)->findBy((['id' => $id]));
       return $this->render('devis_service/index.html.twig', ['devis_services'=>$devis]);
    }


}
