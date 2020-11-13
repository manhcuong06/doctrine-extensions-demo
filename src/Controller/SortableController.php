<?php

namespace App\Controller;

use App\Entity\Sortable;
use App\Form\SortableType;
use App\Repository\SortableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sortable")
 */
class SortableController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/", name="sortable_index", methods={"GET"})
     */
    public function index(SortableRepository $sortableRepository): Response
    {
        $sortables = $this->em
            ->getRepository(Sortable::class)
            ->getBySortableGroups(['category' => 'category 1'])
        ;

        return $this->render('sortable/index.html.twig', [
            'sortables' => $sortables,
            'sortablesBasic' => $sortableRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sortable_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sortable = new Sortable();
        $form = $this->createForm(SortableType::class, $sortable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sortable);
            $entityManager->flush();

            return $this->redirectToRoute('sortable_index');
        }

        return $this->render('sortable/new.html.twig', [
            'sortable' => $sortable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sortable_show", methods={"GET"})
     */
    public function show(Sortable $sortable): Response
    {
        return $this->render('sortable/show.html.twig', [
            'sortable' => $sortable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sortable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sortable $sortable): Response
    {
        $form = $this->createForm(SortableType::class, $sortable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sortable_index');
        }

        return $this->render('sortable/edit.html.twig', [
            'sortable' => $sortable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sortable_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sortable $sortable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sortable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sortable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sortable_index');
    }
}
