<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/product/{id}", name="onceProduct")
     */
    public function onceProduct(ProductRepository $productRepository, $id)
    {
        $product = $productRepository->find($id);

        return $this->render('product/onceProduct.html.twig', [
            'product' => $product,
        ]);
    }
}
