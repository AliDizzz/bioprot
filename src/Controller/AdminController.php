<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index( ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'products' => $products,
        ]);
    }

        /**
     * @Route("/admin/addNewProduct", name="addNewProduct")
     * @Route("/admin/editProduct/{id}", name="editProduct", methods="GET|POST")
     */
    public function editProduct(Product $product = null, Request $request, EntityManagerInterface $entityManagerInterface)
    {
        if (!$product) {
            $product = new Product();
            $product->setCreatedAt(new \DateTime());
        }
        $formProduct = $this->createForm(ProductType::class, $product);
        $formProduct->handleRequest($request);
        if ($formProduct->isSubmitted() && $formProduct->isValid()) {
            $entityManagerInterface->persist($product);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/addNewProduct.html.twig', [
            'product' => $product,
            'formP' => $formProduct->createView(),
        ]);
    }

            /**
     * @Route("/admin/removeProduct/{id}", name="removeProduct", methods="SUP")
     */
    public function addNewProduct(Product $product = null, Request $request, EntityManagerInterface $entityManagerInterface)
    {
        if ($this->isCsrfTokenValid("SUP" . $product->getid(), $request->get('_token'))) {
            $entityManagerInterface->remove($product);
            $entityManagerInterface->flush();
            return $this->redirectToRoute("admin");
        }
    }
}
