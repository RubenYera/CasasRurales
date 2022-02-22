<?php

namespace App\Controller;

use App\Entity\Alojamiento;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

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
