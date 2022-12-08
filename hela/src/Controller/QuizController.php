<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class QuizController extends AbstractController
{
    private $ll;
    #[Route('/quiz', name: 'app_quiz')]
    public function index(): Response
    {
        return $this->render('quiz/index.html.twig', [
            'controller_name' => 'QuizController',
        ]);
    }
    #[Route('/AfficheQuiz', name: 'affichequiz')]
    public function  Afficherquiz(QuizRepository $repository): Response
    {
        $quiz=$repository->findAll();
        return $this->render('quiz/AfficheQuiz.html.twig', ['quiz'=>$quiz]);
    }
    #[Route('/DeleteQuiz/{id}', name: 'deleteQuiz')]
    function Delete($id, QuizRepository $repository): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $quiz=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($quiz);
        $em->flush();
        return $this->redirectToRoute( 'affichequiz');
    }

    #[Route('/Quiz/Add', name: 'ajouterquiz')]
    function add(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $quiz= new Quiz();
        $form=$this->createForm(QuizType::class,$quiz);
        $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();
            return $this->redirectToRoute('affichequiz');
        }

        return $this->render('quiz/AddQuiz.html.twig', ['form'=>$form->createView()]);
    }
    #[Route('/quiz/UpdateQuiz/{id}', name: 'updateQuiz')]
    function Update(QuizRepository $repository,$id,\Symfony\Component\HttpFoundation\Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $quiz = $repository->find($id);
        $form = $this->createForm(QuizType::class, $quiz);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('affichequiz');
        }
        return $this->render('quiz/UpdateQuiz.html.twig', ['f' => $form->createView()]);


    }
    #[Route('/Quiz/RechercheQuiz/', name: 'recherchequiz')]
    function Recherche(QuizRepository $repository,Request $request): Response
    {
        $data=$request->get('search');
        $quiz=$repository->findBy(['id'=>$data]);
        return $this->render('quiz/AfficheQuiz.html.twig', ['quiz'=>$quiz]);


    }
    #[Route('/AfficheQuizFront', name: 'affichequizfront')]

    public function afficherQuizFront(): Response
    {

        $quiz = $this->getDoctrine()->getRepository(Quiz::class)->findAll();
        $lists=[];

        for ($i=0 ; $i<count($quiz);$i++){
            $lists[$i]=$quiz[$i]->getId();
        }


        $listId=[];
        for ($i=0 ; $i<8;$i++){
            $a=array_rand($lists);
            $listId[$i]=$lists[$a];
            unset($lists[$a]);
        }

        // dd(in_array(2,$listId) );
        for ($j=0 ; $j<count($quiz);$j++)
        {
            if (in_array($quiz[$j]->getID(),$listId))
            {
                $quizFinal[$j]=$quiz[$j];
            }
        }
        return $this->render("quiz/afficheQuizFront.html.twig", ['quiz' => $quizFinal]);
    }

    #[Route('/hh', name: 'bb')]
    function hh(QuizRepository $repository,Request $request,FlashyNotifier $flushy): Response
    {
        //$connectedUser = $this->getDoctrine()->getRepository(Users::class)->find(30);

        //  $repository = $this->getDoctrine()->getRepository(Quiz::class)->findAll();

        // $c = $quiz->getReponse();

        $r=[$request->get('option1'),$request->get('option2'),$request->get('option3'),$request->get('option4'),$request->get('option5'),
            $request->get('option6'),$request->get('option7'),$request->get('option8'),$request->get('option9'),$request->get('option10')];
        $quiz = $this->getDoctrine()->getRepository(Quiz::class)->findBy(['reponse'=>$r]);
        if (count($quiz)==8)
        {
            $flushy->success('félicitation! vous avez gagnez un cadeau merci pour votre participation', 'http://your-awesome-link.com');

            return $this->redirectToRoute('affichequizfront');
        }
        else
        {
            $flushy->error('vous avez rater le cadeau merci de ressayer une autre fois ');
            return $this->redirectToRoute('affichequizfront');

        }
        /* if ($r == NULL]{}
        else{
            if (strcmp($c, $r) == 0){


            }

        }*/
    }
    /*
    #[Route('/AfficheQuizFront', name: 'affichequizfront')]

    public function afficherQuizFront(Request $request,MailerInterface $mailer): Response
    {
        $connectedUser = $this->getDoctrine()->getRepository(Users::class)->find(30);

        $QuizValid = $this->getDoctrine()->getManager()
            ->createQuery('SELECT i
            FROM App\Entity\Quiz i')
            ->getOneOrNullResult();

        $c1 = $QuizValid->getReponse();

        $r1 = $request->query->get('option1');
        $r2 = $request->query->get('option2');
        $r3 = $request->query->get('option3');

        if ($r1 == NULL && $r2 == NULL && $r3 == NULL) {

        } else {

            if ((strcmp($c1, $r1) == 0) && (strcmp($c1, $r2) == 0) && (strcmp($c1, $r3) == 0)) {
                //Notif
                $this->addFlash('success', 'Quiz valide  avec succées!');
              //  $connectedUser->setScore($connectedUser->getScore() + 10);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                //email update score to user
                $email = (new Email())
                    ->from('hela.talbi@esprit.tn')
                    ->to($connectedUser->getMail())
                    ->subject('Félicitation ' . $connectedUser->getNom().'! ')
                    ->text('Felicitation!');
                $mailer->send($email);
            } else {
                $this->addFlash('error', 'Quiz non valide!');
            }
        }
        return $this->render("quiz/AfficheQuizFront.html.twig", array('QuizValide' => $QuizValid));
    }*/



}
