<?php

namespace App\Controller;

use App\Entity\Datospersonales;
use App\Form\DatospersonalesType;
use App\Repository\DatospersonalesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/datospersonales')]
class DatospersonalesController extends AbstractController
{
    #[Route('/', name: 'app_datospersonales_index', methods: ['GET'])]
    public function index(DatospersonalesRepository $datospersonalesRepository): Response
    {
        return $this->render('datospersonales/index.html.twig', [
            'datospersonales' => $datospersonalesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_datospersonales_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $datospersonale = new Datospersonales();
        $form = $this->createForm(DatospersonalesType::class, $datospersonale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($datospersonale);
            $entityManager->flush();

            return $this->redirectToRoute('app_datospersonales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('datospersonales/new.html.twig', [
            'datospersonale' => $datospersonale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_datospersonales_show', methods: ['GET'])]
    public function show(Datospersonales $datospersonale): Response
    {
        return $this->render('datospersonales/show.html.twig', [
            'datospersonale' => $datospersonale,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_datospersonales_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Datospersonales $datospersonale, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DatospersonalesType::class, $datospersonale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_datospersonales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('datospersonales/edit.html.twig', [
            'datospersonale' => $datospersonale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_datospersonales_delete', methods: ['POST'])]
    public function delete(Request $request, Datospersonales $datospersonale, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$datospersonale->getId(), $request->request->get('_token'))) {
            $entityManager->remove($datospersonale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_datospersonales_index', [], Response::HTTP_SEE_OTHER);
    }
}
