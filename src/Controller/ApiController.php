<?php

namespace App\Controller;

use App\Entity\Alojamiento;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    #[Route('/Api/JSON_Alojamientos', name: 'JSON_Alojamientos')]
    public function JSON_Alojamiento(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $alojamientos = $entityManager->getRepository(Alojamiento::class)->alojamiento();

        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);
        
        return (new JsonResponse())->setContent($serializer->serialize($alojamientos, 'json'));

    }
}