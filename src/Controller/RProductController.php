<?php

namespace App\Controller;

use App\Entity\RProduct;
use App\Form\RProductType;
use App\Repository\RProductRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/r-product")
 */
class RProductController extends AbstractController
{
    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    /**
     * @Route("/", name="r_product_index", methods={"GET"})
     */
    public function index(RProductRepository $rProductRepository): Response
    {
        return $this->render('r_product/index.html.twig', [
            'r_products' => $rProductRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="r_product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rProduct = new RProduct();
        $form = $this->createForm(RProductType::class, $rProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $fileName = $this->fileUploader->upload($image, rProduct::DIRECTORY);
                $rProduct->setImage($fileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rProduct);
            $entityManager->flush();

            return $this->redirectToRoute('r_product_index');
        }

        return $this->render('r_product/new.html.twig', [
            'r_product' => $rProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="r_product_show", methods={"GET"})
     */
    public function show(RProduct $rProduct): Response
    {
        return $this->render('r_product/show.html.twig', [
            'r_product' => $rProduct,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="r_product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RProduct $rProduct): Response
    {
        $form = $this->createForm(RProductType::class, $rProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $fileName = $this->fileUploader->upload($image, rProduct::DIRECTORY);
                $rProduct->setImage($fileName);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('r_product_index');
        }

        return $this->render('r_product/edit.html.twig', [
            'r_product' => $rProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="r_product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RProduct $rProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rProduct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('r_product_index');
    }
}
