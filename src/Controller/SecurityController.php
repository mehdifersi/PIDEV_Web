<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UsersRepository;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Users;
use App\Form\ForgotPasswordType;
use App\Form\ResetPasswordType;
use PHPMailer\PHPMailer\PHPMailer;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    #[Route(path: '/forgot', name: 'app_forgot')]

    public function forgotPassword(Request $request, UsersRepository $userRepository, TokenGeneratorInterface  $tokenGenerator)
    {


        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $donnees = $form->getData();//


            $user = $userRepository->findOneBy(['email'=>$donnees]);
            if(!$user) {
                $this->addFlash('danger','cette adresse n\'existe pas');
                return $this->redirectToRoute("forgot");

            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManger = $this->getDoctrine()->getManager();
                $entityManger->persist($user);
                $entityManger->flush();
                $url = $this->generateUrl('app_reset_password',array('token'=>$token),UrlGeneratorInterface::ABSOLUTE_URL);

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
                $mail->Subject = 'Password reinstall';//Message subject
                $mail->Body = "<p> Bonjour une demande de réinitialisation de mot de passe a été effectuée. Veuillez cliquer sur le lien suivant :".$url.
                    "</p>";
    
                    $mail->addAddress($user->getEmail());// Target email
    
    
                    $mail->send();    
                $this->addFlash('message','E-mail  de réinitialisation du mp envoyé :');
               //return $this->redirectToRoute("app_reset_password");

            }catch(\Exception $exception) {
                $this->addFlash('warning','une erreur est survenue :'.$exception->getMessage());
                return $this->redirectToRoute("app_login");
            }

        }

        return $this->render("security/forgotPassword.html.twig",['form'=>$form->createView()]);
    }


    #[Route(path: '/resetpassword/{token}', name: 'app_reset_password')]

    public function resetpassword(Request $request, $token, UserPasswordEncoderInterface  $passwordEncoder, EntityManagerInterface $entitymanager)
    {
        $user = $entitymanager
            ->getRepository(Users::class)->findOneBy(['reset_token' => $token]);
            if($request->isMethod('POST')) {
                $user->setResetToken(null);
                $user->setPassword($request->get('password'));
            $entityManger = $this->getDoctrine()->getManager();
            $entityManger->persist($user);
            $entityManger->flush();

            $this->addFlash('message','Mot de passe mis à jour :');
            return $this->render("security/resetPassword.html.twig",['token'=>$token]);

        }
        else {
            return $this->render("security/resetPassword.html.twig",['token'=>$token]);

        }
    }

}
