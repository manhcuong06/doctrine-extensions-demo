<?php

namespace App\Controller;

use App\Entity\RCategory;
use App\Form\RCategoryType;
use App\Repository\RCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/r-category")
 */
class RCategoryController extends AbstractController
{
    /**
     * @Route("/", name="r_category_index", methods={"GET"})
     */
    public function index(RCategoryRepository $rCategoryRepository): Response
    {
        return $this->render('r_category/index.html.twig', [
            'r_categories' => $rCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="r_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rCategory = new RCategory();
        $form = $this->createForm(RCategoryType::class, $rCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rCategory);
            $entityManager->flush();

            return $this->redirectToRoute('r_category_index');
        }

        return $this->render('r_category/new.html.twig', [
            'r_category' => $rCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="r_category_show", methods={"GET"})
     */
    public function show(RCategory $rCategory): Response
    {
        return $this->render('r_category/show.html.twig', [
            'r_category' => $rCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="r_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RCategory $rCategory): Response
    {
        $form = $this->createForm(RCategoryType::class, $rCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('r_category_index');
        }

        return $this->render('r_category/edit.html.twig', [
            'r_category' => $rCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="r_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RCategory $rCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('r_category_index');
    }
}
