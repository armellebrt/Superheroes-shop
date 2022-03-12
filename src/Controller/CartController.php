<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CartController extends AbstractController
{
    /**
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    #[Route('/cart/add/{productId}/{quantity}', name: 'addToCart')]
    public function addToCart(
        SessionInterface $session,
        ProductsRepository $productRepo,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        $productId,
        $quantity
    ): Response {

        // return products list in $_SESSION['cart'] or []
        $cart = $session->get('cart', []);
        $product = $productRepo->find($productId);

        if ($product) {
            $productStock = $product->getStock();
            //if there are less stock than quantity selected (which should never happend)
            if($quantity > $productStock) $quantity = $productStock;
            $productPrice = $product->getPrice();

            //create product if product not already in cart array
            if (!isset($cart['items'][$product->getId()])) {
                //encode entity object to string (to send in json)
                $productString = $serializer->normalize($product);
                $productString['qty'] = $quantity;
                $totalProduct = $productPrice * $quantity;
                $productString['totalPrice'] = $totalProduct;
            } else {
                //update quantity if it's already in cart array
                $productString = $cart['items'][$product->getId()];
                $productString['qty'] = $productString['qty'] + $quantity;
                $totalProduct = $productPrice * $productString['qty'];
                $productString['totalPrice'] += $totalProduct;
            }

            $product->setStock(($productStock-$quantity));

            $entityManager->persist($product);
            $entityManager->flush();

            $cart['items'][$productString['id']] = $productString;

            //update cart total price
            $totalCart = $cart['total_cart'] ?? 0;
            $totalCart += $totalProduct;
            $cart['total_cart'] = $totalCart;
        }
        //add product to the cart
        $session->set('cart', $cart);

        return $this->getMinicart($cart);
    }

    #[Route('/cart', name: 'cart')]
    public function showCart(SessionInterface $session, ProductsRepository $productRepo): Response
    {
        // return products list in $_SESSION['cart'] or []
        return $this->render('cart/index.html.twig',
            ['products' => $session->get('cart', [])]
        );

    }

    public function getMinicart($cart = null, SessionInterface $session): Response
    {
        if (!$cart)  $cart = $session->get('cart');
        return $this->renderForm('cart/minicart.html.twig',
        ['cart' => $cart]);
    }
}
