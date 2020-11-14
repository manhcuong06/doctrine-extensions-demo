<?php

namespace App\Controller;

use App\Entity\Translatable;
use App\Form\TranslatableType;
use App\Repository\TranslatableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/translatable")
 */
class TranslatableController extends AbstractController
{
    /**
     * @Route("/", name="translatable_index", methods={"GET"})
     */
    public function index(TranslatableRepository $translatableRepository): Response
    {
        return $this->render('translatable/index.html.twig', [
            'translatables' => $translatableRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="translatable_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $translatable = new Translatable();
        $form = $this->createForm(TranslatableType::class, $translatable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($translatable);
            $entityManager->flush();

            return $this->redirectToRoute('translatable_index');
        }

        return $this->render('translatable/new.html.twig', [
            'translatable' => $translatable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="translatable_show", methods={"GET"})
     */
    public function show(Translatable $translatable): Response
    {
        return $this->render('translatable/show.html.twig', [
            'translatable' => $translatable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="translatable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Translatable $translatable): Response
    {
        $form = $this->createForm(TranslatableType::class, $translatable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('translatable_index');
        }

        return $this->render('translatable/edit.html.twig', [
            'translatable' => $translatable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="translatable_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Translatable $translatable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$translatable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($translatable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('translatable_index');
    }
}
