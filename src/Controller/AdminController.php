<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(ProductsRepository $productsRepository, UsersRepository $usersRepository): Response
    {
        $products = $productsRepository->findAll();
        $users = $usersRepository->findAll();

        $adminNumber = count($usersRepository->findAdmin());
        $usersNumber = count($users);

        $listProductsStock = [];
        $totalStock = 0;
        foreach($products as $product) {
            $stock = $product->getStock();
            $listProductsStock[$product->getName()] = $stock;
            $totalStock += $stock;
        }

        $numberProducts = count($listProductsStock);

        return $this->render('admin/index.html.twig', [
            'numberProducts' => $numberProducts,
            'totalProducts' => $totalStock,
            'listProductsStock' => json_encode($listProductsStock, JSON_FORCE_OBJECT),
            'userNumber' => $usersNumber,
            'adminNumber' => $adminNumber
        ]);
    }
}
