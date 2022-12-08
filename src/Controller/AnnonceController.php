<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Bien;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Knp\Bundle\PaginatorBundle;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use App\Knp\Bundle;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAware;


class AnnonceController extends AbstractController
{
    #[Route('/annonce', name: 'app_annonce')]
    public function index(): Response
    {
        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
    }

    #[Route('/AfficheAnnonce', name: 'afficheannonce')]
    public function  Afficher(AnnonceRepository $repository): Response
    {
        $annonce=$repository->findAll();
        return $this->render('annonce/AfficheAnnonce.html.twig', ['annonce'=>$annonce]);
    }
    #[Route('/DeleteAnnonce/{id}', name: 'deleteannonce')]
    function Delete($id, AnnonceRepository $repository,FlashyNotifier $flushy): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $annonce=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($annonce);
        $em->flush();
        $flushy->success('Votre annonce est supprimé avec succés', 'http://your-awesome-link.com');

        return $this->redirectToRoute( 'afficheannonce');
    }

    #[Route('/Annonce/Add', name: 'ajouterannonce')]
    function add(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager , SluggerInterface $slugger,FlashyNotifier $flushy): Response
    {
        $annonce= new Annonce();
        $ref=$this->generateRef();
        $tab = $entityManager
            ->getRepository(Annonce::class)->findBy(['refAnnonce' => $ref]);
        while(count($tab)!=0)
        {
            $ref=$this->generateRef();
            $tab = $entityManager
                ->getRepository(Annonce::class)->findBy(['refAnnonce' => $ref]);
        }
        $annonce->setRefAnnonce($ref);
        $form=$this->createForm(AnnonceType::class,$annonce);
        $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $brochureFile = $form->get('afficheAnnonce')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
                try {
                    $brochureFile->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $annonce->setAfficheAnnonce($newFilename);
            }
            $em=$this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();
            $flushy->success('Votre annonce est ajouté avec succés', 'http://your-awesome-link.com');

            return $this->redirectToRoute('afficheannonce');
        }
        return $this->render('annonce/AddAnnonce.html.twig', ['form'=>$form->createView()]);

    }
    #[Route('/Annonce/UpdateAnnonce/{id}', name: 'updateannonce')]
    function Update(AnnonceRepository $repository,$id,\Symfony\Component\HttpFoundation\Request $request, SluggerInterface $slugger,FlashyNotifier $flushy): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $annonce = $repository->find($id);
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('afficheAnnonce')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
                try {
                    $brochureFile->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $annonce->setAfficheAnnonce($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $flushy->success('Votre annonce est modifiée avec succés', 'http://your-awesome-link.com');

            return $this->redirectToRoute('afficheannonce');
        }
        return $this->render('annonce/UpdateAnnonce.html.twig', ['f' => $form->createView()]);


    }
    #[Route('/Annonce/RechercheAnnonce/', name: 'rechercheannonce')]
    function Recherche(AnnonceRepository $repository,Request $request,FlashyNotifier $flushy): Response
    {
        $data=$request->get('search');
        $annonce=$repository->findBy(['refAnnonce'=>$data]);
        $flushy->success('Votre annonce est trouvé avec succés', 'http://your-awesome-link.com');

        return $this->render('annonce/AfficheAnnonce.html.twig', ['annonce'=>$annonce]);


    }
    public function generateRef():string{
        $ref="RF-";
        for ($x = 0; $x < 8; $x++) {
            $tmp=strval(rand(0,9));
            $ref= $ref . $tmp;
        }
        return $ref;

    }

    #[Route('/AfficheAnnoncefront', name: 'afficheannoncefront')]
    public function  Afficherfront(AnnonceRepository $repository): Response
    {
        $annonce=$repository->findAll();
        return $this->render('annonce/AfficheAnnoncefront.html.twig', ['annonce'=>$annonce]);
    }
    #[Route('/DeleteAnnoncefront/{id}', name: 'deletefront')]
    function Deletefront($id, AnnonceRepository $repository,FlashyNotifier $flushy): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $annonce=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($annonce);
        $em->flush();
        $flushy->success('Votre annonce est supprimé avec succés', 'http://your-awesome-link.com');

        return $this->redirectToRoute( 'afficheannoncefront');
    }

    #[Route('/Annonce/Addfront', name: 'ajouterannoncefront')]
    function addfront(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger,FlashyNotifier $flushy): Response
    {
        $annonce= new Annonce();
        $ref=$this->generateRef();
        $tab = $entityManager
            ->getRepository(Annonce::class)->findBy(['refAnnonce' => $ref]);
        while(count($tab)!=0)
        {
            $ref=$this->generateRef();
            $tab = $entityManager
                ->getRepository(Annonce::class)->findBy(['refAnnonce' => $ref]);
        }
        $annonce->setRefAnnonce($ref);
        $form=$this->createForm(AnnonceType::class,$annonce);
        $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $brochureFile = $form->get('afficheAnnonce')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
                try {
                    $brochureFile->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $annonce->setAfficheAnnonce($newFilename);
            }
            $em=$this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();
            $flushy->success('Votre annonce est ajouté avec succés', 'http://your-awesome-link.com');

            return $this->redirectToRoute('afficheannoncefront');
        }
        return $this->render('annonce/AddAnnoncefront.html.twig', ['form'=>$form->createView()]);
    }

    #[Route('/Annonce/UpdateAnnoncefront/{id}', name: 'updatefront')]
    function Updatefront(AnnonceRepository $repository,$id,\Symfony\Component\HttpFoundation\Request $request, SluggerInterface $slugger,FlashyNotifier $flushy): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $annonce = $repository->find($id);
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('afficheAnnonce')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
                try {
                    $brochureFile->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $annonce->setAfficheAnnonce($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $flushy->success('Votre annonce est modifié avec succés', 'http://your-awesome-link.com');

            return $this->redirectToRoute('afficheannoncefront');
        }
        return $this->render('annonce/UpdateAnnoncefront.html.twig', ['f' => $form->createView()]);


    }
    #[Route('/Annonce/RechercheAnnoncefront/', name: 'rechercheAnnoncefront')]
    function Recherchefront(AnnonceRepository $repository,Request $request,FlashyNotifier $flushy): Response
    {
        $data=$request->get('search');
        $annonce=$repository->findBy(['refAnnonce'=>$data]);
        $flushy->success('Votre annonce est trouvé avec succés', 'http://your-awesome-link.com');

        return $this->render('annonce/AfficheAnnoncefront.html.twig', ['annonce'=>$annonce]);


    }
    #[Route('/tmp3', name : 'sflkjfkls')]
public function paginatoor(PaginatorInterface $paginator, EntityManagerInterface $entityManager, Request $request):Response{

        $donnees = $entityManager->getRepository(Annonce::class)->findAll();
        $articles = $paginator->paginate($donnees);


        return $this->render('annonce/paginator.html.twig',['donnees'=>$articles]);
    }


}

