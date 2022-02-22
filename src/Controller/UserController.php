<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\AltaMasivaUserFormType;

class UserController extends AbstractController
{

    #[Route('/usuario/Alta_Masiva', name: 'Alta_Masiva_Usuario')]
    public function Alta_Masiva(Request $request,ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $user = new User();
        $form = $this->createForm(AltaMasivaUserFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $texto = $form->getData();
            
            var_dump($form->getData());
            // $entityManager->persist($usuario);
            // $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('user/user.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
