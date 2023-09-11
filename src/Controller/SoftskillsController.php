<?php

namespace App\Controller;

use App\Entity\Softskills;
use App\Form\SoftskillsType;
use App\Repository\SoftskillsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/softskills')]
class SoftskillsController extends AbstractController
{
    #[Route('/', name: 'app_softskills_index', methods: ['GET'])]
    public function index(SoftskillsRepository $softskillsRepository): Response
    {
        return $this->render('softskills/index.html.twig', [
            'softskills' => $softskillsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_softskills_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $softskill = new Softskills();
        $form = $this->createForm(SoftskillsType::class, $softskill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($softskill);
            $entityManager->flush();

            return $this->redirectToRoute('app_softskills_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('softskills/new.html.twig', [
            'softskill' => $softskill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_softskills_show', methods: ['GET'])]
    public function show(Softskills $softskill): Response
    {
        return $this->render('softskills/show.html.twig', [
            'softskill' => $softskill,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_softskills_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Softskills $softskill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SoftskillsType::class, $softskill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_softskills_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('softskills/edit.html.twig', [
            'softskill' => $softskill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_softskills_delete', methods: ['POST'])]
    public function delete(Request $request, Softskills $softskill, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$softskill->getId(), $request->request->get('_token'))) {
            $entityManager->remove($softskill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_softskills_index', [], Response::HTTP_SEE_OTHER);
    }
}
