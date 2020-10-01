<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/createUser", name="creatUser")
     */
    public function createUser( Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {
        $user = new User();
        $formUser = $this->createForm(UserType::class,$user);
        $formUser->handleRequest($request);
        if( $formUser->isSubmitted() && $formUser->isValid()){
            $encoder = $userPasswordEncoderInterface->encodePassword($user, $user->getPassword());
            $user->setPassword($encoder);
            $user->setRoles('ROLE_USER');
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();
            return $this->redirectToRoute("home");
        }

        return $this->render('user/index.html.twig', [
            'formUser' => $formUser->createView(),
        ]);
    }


        /**
     * @Route("/loginUser", name="loginUser")
     */
    public function loginUser( AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('user/login.html.twig', [
            'lastUserName' => $authenticationUtils->getLastUsername(),
            'error' => $error !== null,
        ]);

    }
}
