<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;



class BienController extends AbstractController
{
    #[Route('/bien', name: 'app_bien')]
    public function index(): Response
    {
        return $this->render('bien/index.html.twig', [
            'controller_name' => 'BienController',
        ]);
    }
    #[Route('/AfficheBien', name: 'affichebien')]
    public function  Afficher(BienRepository $repository): Response
    {
        $bien=$repository->findAll();
        return $this->render('bien/AfficheBien.html.twig', ['bien'=>$bien]);
    }
    #[Route('/DeleteBien/{id}', name: 'deletebien')]
    function Delete($id, BienRepository $repository,FlashyNotifier $flushy): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $bien=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($bien);
        $em->flush();
        $flushy->success('Votre bien est supprimé avec succés', 'http://your-awesome-link.com');

        return $this->redirectToRoute( 'affichebien');
    }

    #[Route('/Bien/Add', name: 'ajouterbiens')]
    function add(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger,FlashyNotifier $flushy): Response
    {
        $bien= new Bien();
        //$evenement= new Bien();
        $ref=$this->generateRef();
        $tab = $entityManager
            ->getRepository(Bien::class)->findBy(['RefBien' => $ref]);
        while(count($tab)!=0)
        {
            $ref=$this->generateRef();
            $tab = $entityManager
                ->getRepository(Bien::class)->findBy(['RefBien' => $ref]);
        }
        $bien->setRefBien($ref);
        $form=$this->createForm(BienType::class,$bien);
        $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($bien);
            $entityManager->flush();
            $flushy->success('Votre bien est ajouté avec succés', 'http://your-awesome-link.com');



            return $this->redirectToRoute('affichebien', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bien/AddBien.html.twig', ['form'=>$form->createView()]);
    }
    #[Route('/Bien/UpdateBien/{id}', name: 'updatebien')]
    function Update(BienRepository $repository,$id,\Symfony\Component\HttpFoundation\Request $request, SluggerInterface $slugger,FlashyNotifier $flushy): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $bien = $repository->find($id);
        $form = $this->createForm(BienType::class, $bien);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $flushy->success('Votre bien est modifié avec succés', 'http://your-awesome-link.com');

            return $this->redirectToRoute('affichebien');
        }
        return $this->render('bien/UpdateBien.html.twig', ['f' => $form->createView()]);


    }
    #[Route('/Bien/RechercheBien/', name: 'recherchebien')]
    function Recherche(BienRepository $repository,Request $request,FlashyNotifier $flushy): Response
    {
        $data=$request->get('search');
        $bien=$repository->findBy(['RefBien'=>$data]);
        $flushy->success('Votre bien est trouvé avec succés', 'http://your-awesome-link.com');

        return $this->render('bien/AfficheBien.html.twig', ['bien'=>$bien]);


    }
    public function generateRef():string{
        $ref="RF-";
        for ($x = 0; $x < 8; $x++) {
            $tmp=strval(rand(0,9));
            $ref= $ref . $tmp;
        }
        return $ref;

    }

    #[Route('/AfficheBienfront', name: 'affichebienfront')]
    public function  Afficherfront(BienRepository $repository): Response
    {
        $bien=$repository->findAll();
        return $this->render('bien/AfficheBienfront.html.twig', ['bien'=>$bien]);
    }
    #[Route('/DeleteBienfront/{id}', name: 'deletefront')]
    function Deletefront($id, BienRepository $repository,FlashyNotifier $flushy): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $bien=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($bien);
        $em->flush();
        $flushy->success('Votre bien est supprimé avec succés', 'http://your-awesome-link.com');

        return $this->redirectToRoute( 'affichebienfront');
    }

    #[Route('/Bien/Addfront', name: 'ajouterbienfront')]
    function addfront(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger ,FlashyNotifier $flushy/*, SluggerInterface $slugger ,BienRepository $evenementRepository*/
    ): Response
    {


        $bien= new Bien();
        //$evenement= new Bien();
        $ref=$this->generateRef();
        $tab = $entityManager
            ->getRepository(Bien::class)->findBy(['RefBien' => $ref]);
        while(count($tab)!=0)
        {
            $ref=$this->generateRef();
            $tab = $entityManager
                ->getRepository(Bien::class)->findBy(['RefBien' => $ref]);
        }
        $bien->setRefBien($ref);
        $form=$this->createForm(BienType::class,$bien);
        $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager->persist($bien);
            $entityManager->flush();
            $flushy->success('Votre bien est ajouté avec succés', 'http://your-awesome-link.com');



            return $this->redirectToRoute('affichebienfront', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bien/AddBienfront.html.twig', ['form'=>$form->createView()]);
    }
    #[Route('/Bien/UpdateBienfront/{id}', name: 'updatefront')]
    function Updatefront(BienRepository $repository,$id,\Symfony\Component\HttpFoundation\Request $request, SluggerInterface $slugger,FlashyNotifier $flushy): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $bien = $repository->find($id);
        $form = $this->createForm(BienType::class, $bien);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $flushy->success('Votre bien est modifié avec succés', 'http://your-awesome-link.com');

            return $this->redirectToRoute('affichebienfront');
        }
        return $this->render('bien/UpdateBienfront.html.twig', ['f' => $form->createView()]);


    }
    #[Route('/Bien/RechercheBienfront/', name: 'recherchebienfront')]
    function Recherchefront(BienRepository $repository,Request $request,FlashyNotifier $flushy): Response
    {
        $data=$request->get('search');
        $bien=$repository->findBy(['RefBien'=>$data]);
        $flushy->success('Votre bien est trouvé avec succés', 'http://your-awesome-link.com');

        return $this->render('bien/AfficheBienfront.html.twig', ['bien'=>$bien]);


    }


}
