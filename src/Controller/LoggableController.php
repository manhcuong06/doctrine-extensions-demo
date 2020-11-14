<?php

namespace App\Controller;

use App\Entity\Loggable;
use App\Form\LoggableType;
use App\Repository\LoggableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/loggable")
 */
class LoggableController extends AbstractController
{
    /**
     * @Route("/", name="loggable_index", methods={"GET"})
     */
    public function index(LoggableRepository $loggableRepository): Response
    {
        return $this->render('loggable/index.html.twig', [
            'loggables' => $loggableRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="loggable_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $loggable = new Loggable();
        $form = $this->createForm(LoggableType::class, $loggable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($loggable);
            $entityManager->flush();

            return $this->redirectToRoute('loggable_index');
        }

        return $this->render('loggable/new.html.twig', [
            'loggable' => $loggable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="loggable_show", methods={"GET"})
     */
    public function show(Loggable $loggable): Response
    {
        return $this->render('loggable/show.html.twig', [
            'loggable' => $loggable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="loggable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Loggable $loggable): Response
    {
        $form = $this->createForm(LoggableType::class, $loggable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('loggable_index');
        }

        return $this->render('loggable/edit.html.twig', [
            'loggable' => $loggable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="loggable_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Loggable $loggable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$loggable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($loggable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('loggable_index');
    }
}
