<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ComodidadController extends AbstractController
{
    #[Route('/JSONcomodidades', name: 'JSON_Comodidades')]
    public function JSON_Comodidades(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $comodidades = $entityManager->getRepository(Comodidad::class)->findAll();

        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];

        $serializer = new Serializer($normalizers, $encoders);
        
        return (new JsonResponse())->setContent($serializer->serialize($comodidades, 'json'));

    }

    #[Route('/JSONcomodidad/{id}', name: 'JSON_comodidad')]
    public function JSON_Comodidad(ManagerRegistry $doctrine,int $id): Response
    {
        $comodidad = $entityManager->getRepository(Comodidad::class)->find($id);

        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);


        return new response($serializer->serialize($comodidad, 'json'));
    }
}
