<?php

namespace App\Controller;

use App\Entity\Softdeleteable;
use App\Form\SoftdeleteableType;
use App\Repository\SoftdeleteableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/softdeleteable")
 */
class SoftdeleteableController extends AbstractController
{
    /**
     * @Route("/", name="softdeleteable_index", methods={"GET"})
     */
    public function index(SoftdeleteableRepository $softdeleteableRepository): Response
    {
        return $this->render('softdeleteable/index.html.twig', [
            'softdeleteables' => $softdeleteableRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="softdeleteable_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $softdeleteable = new Softdeleteable();
        $form = $this->createForm(SoftdeleteableType::class, $softdeleteable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($softdeleteable);
            $entityManager->flush();

            return $this->redirectToRoute('softdeleteable_index');
        }

        return $this->render('softdeleteable/new.html.twig', [
            'softdeleteable' => $softdeleteable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="softdeleteable_show", methods={"GET"})
     */
    public function show(Softdeleteable $softdeleteable): Response
    {
        return $this->render('softdeleteable/show.html.twig', [
            'softdeleteable' => $softdeleteable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="softdeleteable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Softdeleteable $softdeleteable): Response
    {
        $form = $this->createForm(SoftdeleteableType::class, $softdeleteable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('softdeleteable_index');
        }

        return $this->render('softdeleteable/edit.html.twig', [
            'softdeleteable' => $softdeleteable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="softdeleteable_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Softdeleteable $softdeleteable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$softdeleteable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($softdeleteable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('softdeleteable_index');
    }
}
