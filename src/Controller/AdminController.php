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
     */
    public function addNewProduct(Product $product = null, Request $request, EntityManagerInterface $entityManagerInterface)
    {
        $product = new Product();
        $product->setCreatedAt(new \DateTime());
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
}
