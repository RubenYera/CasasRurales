<?php

namespace App\Controller;

use App\Entity\Alojamiento;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;

class AlojamientoController extends AbstractController
{
    #[Route('/alojamiento/{id}', name: 'alojamiento')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $entityManager = $doctrine->getManager();

        $alojamiento = $entityManager->getRepository(Alojamiento::class)->find($id);

        $notas = $entityManager->getRepository(Alojamiento::class)->valoracionesMedias($id);

        if (!$alojamiento) {
            throw $this->createNotFoundException(
                'No hay alojamiento con este '.$id
            );
        }

        return $this->render('alojamiento/alojamiento.html.twig', ['alojamiento' => $alojamiento, 'notas' => $notas]);
    }

    #[Route('/listadoAlojamientos', name: 'Listado_Alojamientos')]
    public function listado(ManagerRegistry $doctrine): Response
    {
        // $entityManager = $doctrine->getManager();

        // $alojamiento = $entityManager->getRepository(Alojamiento::class)->find($id);

        // $notas = $entityManager->getRepository(Alojamiento::class)->valoracionesMedias($id);

        // if (!$alojamiento) {
        //     throw $this->createNotFoundException(
        //         'No hay alojamiento con este '.$id
        //     );
        // }

        return $this->render('alojamiento/listado.html.twig');
    }

    #[Route('/alojamientosJSON', name: 'JSON_Alojamientos')]
    public function JSON_Alojamientos(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $alojamiento = $entityManager->getRepository(Alojamiento::class)->findAll();

        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];

        $serializer = new Serializer($normalizers, $encoders);
        
        return (new JsonResponse())->setContent($serializer->serialize($alojamiento, 'json'));

    }

    #[Route('/alojamientoJSON/{id}', name: 'JSON_Alojamiento')]
    public function JSON_Alojamiento(ManagerRegistry $doctrine,int $id): Response
    {
        $entityManager = $doctrine->getManager();

        $alojamiento = $entityManager->getRepository(Alojamiento::class)->find($id);

        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);
        
        return (new JsonResponse())->setContent($serializer->serialize($alojamiento, 'json'));

    }

    #[Route('/alojamiento/Alta_Masiva', name: 'Alta_Masiva')]
    public function Alta_Masiva(ManagerRegistry $doctrine,Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $form = $this->createForm(ProductoType::class, $producto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $texto = $form->getData();
            $categoria = $entityManager->getRepository(Categoria::class)->find(1);
            $producto->setCategoria($categoria);

            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirectToRoute('producto_listaProductos');
        }

        return $this->renderForm('producto/new.html.twig', [
            'form' => $form,
        ]);
    }
    
}
