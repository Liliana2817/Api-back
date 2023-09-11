<?php

namespace App\Controller;

use App\Entity\Idiomas;
use App\Form\IdiomasType;
use App\Repository\IdiomasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/idiomas')]
class IdiomasController extends AbstractController
{
    #[Route('/', name: 'app_idiomas_index', methods: ['GET'])]
    public function index(IdiomasRepository $idiomasRepository): Response
    {
        return $this->render('idiomas/index.html.twig', [
            'idiomas' => $idiomasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_idiomas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $idioma = new Idiomas();
        $form = $this->createForm(IdiomasType::class, $idioma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($idioma);
            $entityManager->flush();

            return $this->redirectToRoute('app_idiomas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('idiomas/new.html.twig', [
            'idioma' => $idioma,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_idiomas_show', methods: ['GET'])]
    public function show(Idiomas $idioma): Response
    {
        return $this->render('idiomas/show.html.twig', [
            'idioma' => $idioma,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_idiomas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Idiomas $idioma, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IdiomasType::class, $idioma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_idiomas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('idiomas/edit.html.twig', [
            'idioma' => $idioma,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_idiomas_delete', methods: ['POST'])]
    public function delete(Request $request, Idiomas $idioma, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$idioma->getId(), $request->request->get('_token'))) {
            $entityManager->remove($idioma);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_idiomas_index', [], Response::HTTP_SEE_OTHER);
    }
}
