<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/product", name="product_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findBy(
                ['visible'=>true],
                ['created_at'=>'DESC']
            ),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     */
    public function show($id, ProductRepository $productRepository) : response
    {

        $product = $productRepository->find($id);

        if(!$product)
        {
            throw $this->createNotFoundException("Le produit n'existe pas !");
        }

        return $this->render('product/show.html.twig', [
            "product" => $product,
        ]);
    }
}
