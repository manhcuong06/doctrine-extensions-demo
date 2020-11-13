<?php

namespace App\Controller;

use App\Entity\Timestampable;
use App\Form\TimestampableType;
use App\Repository\TimestampableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Gedmo\Blameable\Traits\BlameableEntity;

/**
 * @Route("/timestampable")
 */
class TimestampableController extends AbstractController
{
    /**
     * @Route("/", name="timestampable_index", methods={"GET"})
     */
    public function index(TimestampableRepository $timestampableRepository): Response
    {
        return $this->render('timestampable/index.html.twig', [
            'timestampables' => $timestampableRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="timestampable_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $timestampable = new Timestampable();
        $form = $this->createForm(TimestampableType::class, $timestampable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($timestampable);
            $entityManager->flush();

            return $this->redirectToRoute('timestampable_index');
        }

        return $this->render('timestampable/new.html.twig', [
            'timestampable' => $timestampable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timestampable_show", methods={"GET"})
     */
    public function show(Timestampable $timestampable): Response
    {
        return $this->render('timestampable/show.html.twig', [
            'timestampable' => $timestampable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="timestampable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Timestampable $timestampable): Response
    {
        $form = $this->createForm(TimestampableType::class, $timestampable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timestampable_index');
        }

        return $this->render('timestampable/edit.html.twig', [
            'timestampable' => $timestampable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timestampable_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Timestampable $timestampable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timestampable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($timestampable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('timestampable_index');
    }
}
