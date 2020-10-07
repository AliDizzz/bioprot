<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cartIndex")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository)
    {
        $panier = $session->get('panier', []);  //mon PANIER est egale a ce qu'il y a dans la SESSION qui se nomme PANIER, mais il peut ne rien avoir donc [] tableau vide 

        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach ($panierWithData as $item) {
            $totalItem = $item['product']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]); // passe a mon twig, un ellement qui s'appel 'items'correspondant a mon panierWithData ^^
    }

    /**
     * @Route("/panier/add/{id}", name="cartAdd")
     */
    public function add($id, SessionInterface $session)
    {

        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }



        $session->set('panier', $panier);



        return $this->redirectToRoute("cartIndex");
    }

    /**
     * @Route("/panier/less/{id}", name="cartLess")
     */
    public function less($id, SessionInterface $session)
    {

        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]--;
        }



        $session->set('panier', $panier);



        return $this->redirectToRoute("cartIndex");
    }

    /**
     * @Route("/panier/remove/{id}", name="cartRemove")
     */
    public function remove($id, SessionInterface $session)
    {

        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {             //si cela existe, unset permet de le supprimer
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("cartIndex");
    }
}
