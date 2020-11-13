<?php

namespace App\Controller;

use App\Entity\Sluggable;
use App\Form\SluggableType;
use App\Repository\SluggableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sluggable")
 */
class SluggableController extends AbstractController
{
    /**
     * @Route("/", name="sluggable_index", methods={"GET"})
     */
    public function index(SluggableRepository $sluggableRepository): Response
    {
        return $this->render('sluggable/index.html.twig', [
            'sluggables' => $sluggableRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sluggable_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sluggable = new Sluggable();
        $form = $this->createForm(SluggableType::class, $sluggable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sluggable);
            $entityManager->flush();

            return $this->redirectToRoute('sluggable_index');
        }

        return $this->render('sluggable/new.html.twig', [
            'sluggable' => $sluggable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="sluggable_show", methods={"GET"})
     */
    public function show(Sluggable $sluggable): Response
    {
        return $this->render('sluggable/show.html.twig', [
            'sluggable' => $sluggable,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="sluggable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sluggable $sluggable): Response
    {
        $form = $this->createForm(SluggableType::class, $sluggable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sluggable_index');
        }

        return $this->render('sluggable/edit.html.twig', [
            'sluggable' => $sluggable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="sluggable_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sluggable $sluggable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sluggable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sluggable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sluggable_index');
    }
}
