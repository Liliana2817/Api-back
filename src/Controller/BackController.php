<?php

namespace App\Controller;

use App\Entity\Back;
use App\Form\BackType;
use App\Repository\BackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back')]
class BackController extends AbstractController
{
    #[Route('/', name: 'app_back_index', methods: ['GET'])]
    public function index(BackRepository $backRepository): Response
    {
        return $this->render('back/index.html.twig', [
            'backs' => $backRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $back = new Back();
        $form = $this->createForm(BackType::class, $back);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($back);
            $entityManager->flush();

            return $this->redirectToRoute('app_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/new.html.twig', [
            'back' => $back,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_show', methods: ['GET'])]
    public function show(Back $back): Response
    {
        return $this->render('back/show.html.twig', [
            'back' => $back,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Back $back, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BackType::class, $back);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/edit.html.twig', [
            'back' => $back,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_delete', methods: ['POST'])]
    public function delete(Request $request, Back $back, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$back->getId(), $request->request->get('_token'))) {
            $entityManager->remove($back);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_index', [], Response::HTTP_SEE_OTHER);
    }
}
