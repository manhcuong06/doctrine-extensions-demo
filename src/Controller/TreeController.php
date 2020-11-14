<?php

namespace App\Controller;

use App\Entity\Tree;
use App\Form\TreeType;
use App\Repository\TreeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tree")
 */
class TreeController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(Tree::class);
    }

    /**
     * @Route("/", name="tree_index", methods={"GET"})
     */
    public function index(TreeRepository $treeRepository): Response
    {
        return $this->render('tree/index.html.twig', [
            // 'trees' => $treeRepository->findAll(),
            'trees' => $this->repository->children(),
        ]);
    }

    /**
     * @Route("/new", name="tree_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tree = new Tree();
        $form = $this->createForm(TreeType::class, $tree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parentTitle = $form->get('parentTitle')->getData();
            $parent = $this->repository->findOneByTitle($parentTitle);
            $tree->setParent($parent);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tree);
            $entityManager->flush();

            return $this->redirectToRoute('tree_index');
        }

        return $this->render('tree/new.html.twig', [
            'tree' => $tree,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tree_show", methods={"GET"})
     */
    public function show(Tree $tree): Response
    {
        return $this->render('tree/show.html.twig', [
            'tree' => $tree,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tree_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tree $tree): Response
    {
        $form = $this->createForm(TreeType::class, $tree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parentTitle = $form->get('parentTitle')->getData();
            $parent = $this->repository->findOneByTitle($parentTitle);
            $tree->setParent($parent);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tree_index');
        }

        return $this->render('tree/edit.html.twig', [
            'tree' => $tree,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tree_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tree $tree): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tree->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tree);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tree_index');
    }
}
