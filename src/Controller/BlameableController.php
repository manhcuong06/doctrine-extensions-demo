<?php

namespace App\Controller;

use App\Entity\Blameable;
use App\Form\BlameableType;
use App\Repository\BlameableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blameable")
 */
class BlameableController extends AbstractController
{
    /**
     * @Route("/", name="blameable_index", methods={"GET"})
     */
    public function index(BlameableRepository $blameableRepository): Response
    {
        return $this->render('blameable/index.html.twig', [
            'blameables' => $blameableRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="blameable_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $blameable = new Blameable();
        $form = $this->createForm(BlameableType::class, $blameable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blameable);
            $entityManager->flush();

            return $this->redirectToRoute('blameable_index');
        }

        return $this->render('blameable/new.html.twig', [
            'blameable' => $blameable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blameable_show", methods={"GET"})
     */
    public function show(Blameable $blameable): Response
    {
        return $this->render('blameable/show.html.twig', [
            'blameable' => $blameable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="blameable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Blameable $blameable): Response
    {
        $form = $this->createForm(BlameableType::class, $blameable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blameable_index');
        }

        return $this->render('blameable/edit.html.twig', [
            'blameable' => $blameable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blameable_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Blameable $blameable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blameable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blameable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blameable_index');
    }
}
