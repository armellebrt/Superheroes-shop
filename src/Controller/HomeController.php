<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProductsRepository $productsRepository, Request $request): Response
    {
        $products = $productsRepository->findAll();
        $listProductName = [];
        foreach($products as $product) {
            $listProductName[] = $product->getName();
        }

        $form = $this->createFormBuilder()
            ->add('searchedTerm', TextType::class,[
                'label' => false,
                'attr' => [
                    "class" => "ui-autocomplete-input",
                    'placeholder' => 'Cherchez un pouvoir ou un objet'
                ],
                'required' => false
            ])
            ->add('save', SubmitType::class, [
                'label' => false,
                'attr' => [ "class" => "fa fa-search"]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchedTerm = $form['searchedTerm']->getData();
            if(empty($searchedTerm)) {
                return $this->redirectToRoute('home');
            }
            $products = $productsRepository->searchByName($searchedTerm);
        }

        return $this->render('home/index.html.twig', [
            'products' => $products,
            'numberProducts' => count($products),
            "autocompleteHeader" => $listProductName,
            'form' => $form->createView()
        ]);
    }
}
