<?php

namespace App\Controller;

use App\Entity\Herramientas;
use App\Form\HerramientasType;
use App\Repository\HerramientasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/herramientas')]
class HerramientasController extends AbstractController
{
    #[Route('/', name: 'app_herramientas_index', methods: ['GET'])]
    public function index(HerramientasRepository $herramientasRepository): Response
    {
        return $this->render('herramientas/index.html.twig', [
            'herramientas' => $herramientasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_herramientas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $herramienta = new Herramientas();
        $form = $this->createForm(HerramientasType::class, $herramienta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($herramienta);
            $entityManager->flush();

            return $this->redirectToRoute('app_herramientas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('herramientas/new.html.twig', [
            'herramienta' => $herramienta,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_herramientas_show', methods: ['GET'])]
    public function show(Herramientas $herramienta): Response
    {
        return $this->render('herramientas/show.html.twig', [
            'herramienta' => $herramienta,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_herramientas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Herramientas $herramienta, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HerramientasType::class, $herramienta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_herramientas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('herramientas/edit.html.twig', [
            'herramienta' => $herramienta,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_herramientas_delete', methods: ['POST'])]
    public function delete(Request $request, Herramientas $herramienta, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$herramienta->getId(), $request->request->get('_token'))) {
            $entityManager->remove($herramienta);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_herramientas_index', [], Response::HTTP_SEE_OTHER);
    }
}
