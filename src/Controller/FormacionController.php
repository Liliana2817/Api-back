<?php

namespace App\Controller;

use App\Entity\Formacion;
use App\Form\FormacionType;
use App\Repository\FormacionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formacion')]
class FormacionController extends AbstractController
{
    #[Route('/', name: 'app_formacion_index', methods: ['GET'])]
    public function index(FormacionRepository $formacionRepository): Response
    {
        return $this->render('formacion/index.html.twig', [
            'formacions' => $formacionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formacion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formacion = new Formacion();
        $form = $this->createForm(FormacionType::class, $formacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formacion);
            $entityManager->flush();

            return $this->redirectToRoute('app_formacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formacion/new.html.twig', [
            'formacion' => $formacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formacion_show', methods: ['GET'])]
    public function show(Formacion $formacion): Response
    {
        return $this->render('formacion/show.html.twig', [
            'formacion' => $formacion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formacion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formacion $formacion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormacionType::class, $formacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_formacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formacion/edit.html.twig', [
            'formacion' => $formacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formacion_delete', methods: ['POST'])]
    public function delete(Request $request, Formacion $formacion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formacion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_formacion_index', [], Response::HTTP_SEE_OTHER);
    }
}
