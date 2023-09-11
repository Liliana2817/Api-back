<?php

namespace App\Controller;

use App\Entity\ExperienciLaboral;
use App\Form\ExperienciLaboralType;
use App\Repository\ExperienciLaboralRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/experienci/laboral')]
class ExperienciLaboralController extends AbstractController
{
    #[Route('/', name: 'app_experienci_laboral_index', methods: ['GET'])]
    public function index(ExperienciLaboralRepository $experienciLaboralRepository): Response
    {
        return $this->render('experienci_laboral/index.html.twig', [
            'experienci_laborals' => $experienciLaboralRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_experienci_laboral_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $experienciLaboral = new ExperienciLaboral();
        $form = $this->createForm(ExperienciLaboralType::class, $experienciLaboral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($experienciLaboral);
            $entityManager->flush();

            return $this->redirectToRoute('app_experienci_laboral_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('experienci_laboral/new.html.twig', [
            'experienci_laboral' => $experienciLaboral,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_experienci_laboral_show', methods: ['GET'])]
    public function show(ExperienciLaboral $experienciLaboral): Response
    {
        return $this->render('experienci_laboral/show.html.twig', [
            'experienci_laboral' => $experienciLaboral,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_experienci_laboral_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ExperienciLaboral $experienciLaboral, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExperienciLaboralType::class, $experienciLaboral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_experienci_laboral_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('experienci_laboral/edit.html.twig', [
            'experienci_laboral' => $experienciLaboral,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_experienci_laboral_delete', methods: ['POST'])]
    public function delete(Request $request, ExperienciLaboral $experienciLaboral, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experienciLaboral->getId(), $request->request->get('_token'))) {
            $entityManager->remove($experienciLaboral);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_experienci_laboral_index', [], Response::HTTP_SEE_OTHER);
    }
}
