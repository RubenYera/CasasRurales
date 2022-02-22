<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\AltaMasivaUserFormType;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends AbstractController
{
    #[Route('/usersJSON', name: 'JSON_Users')]
    public function JSON_Users(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $users = $entityManager->getRepository(User::class)->findAll();

        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];

        $serializer = new Serializer($normalizers, $encoders);
        
        // $serializedObject = $serializer->serialize($alojamiento, 'json');
        // return $this->json($serializedObject);
        return (new JsonResponse())->setContent($serializer->serialize($users, 'json'));

    }

    #[Route('/userJSON/{id}', name: 'JSON_User')]
    public function JSON_User(ManagerRegistry $doctrine,int $id): Response
    {
        $entityManager = $doctrine->getManager();

        $user = $entityManager->getRepository(User::class)->find($id);

        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);
        
        return (new JsonResponse())->setContent($serializer->serialize($user, 'json'));

    }

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
