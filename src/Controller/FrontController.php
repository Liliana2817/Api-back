<?php

namespace App\Controller;

use App\Entity\Front;
use App\Form\FrontType;
use App\Repository\FrontRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front')]
class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front_index', methods: ['GET'])]
    public function index(FrontRepository $frontRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'fronts' => $frontRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_front_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $front = new Front();
        $form = $this->createForm(FrontType::class, $front);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($front);
            $entityManager->flush();

            return $this->redirectToRoute('app_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/new.html.twig', [
            'front' => $front,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_front_show', methods: ['GET'])]
    public function show(Front $front): Response
    {
        return $this->render('front/show.html.twig', [
            'front' => $front,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_front_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Front $front, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FrontType::class, $front);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/edit.html.twig', [
            'front' => $front,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_front_delete', methods: ['POST'])]
    public function delete(Request $request, Front $front, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$front->getId(), $request->request->get('_token'))) {
            $entityManager->remove($front);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_front_index', [], Response::HTTP_SEE_OTHER);
    }
}
