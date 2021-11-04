<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product_index")
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
     * @Route("/product/{id}", name="product_show", priority=-1)
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


    /**
     * @Route("/product/add", name="product_add", methods={"GET","POST"})
     */
    public function add(Request $request)
    {
        $product = new Product;
        $formProduct = $this-> createForm(ProductType::class, $product);
        $formProduct->handleRequest($request);

        if($formProduct->isSubmitted() && $formProduct->isValid())
        {
           dd($formProduct);

            $product->setCreatedAt( new \DateTime())
                ->setUpdatedAt($product->getCreatedAt());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success','Le produit à été ajouté');

            return $this->redirectToRoute('product_index');
        }

        return $this->renderForm('product/add.html.twig', [
            'formProduct' => $formProduct
        ]);
    }

    /**
     * @Route("/product/edit/{id}", name="product_edit", methods={"GET", "POST"})
     */
    public function edit($id, ProductRepository $productRepository, Request $request)
    {
        $product = $productRepository->find($id);

        if(!$product) 
        {
            throw $this->createNotFoundException("Le produit à modifier n'existe pas.");
        }

        $formProduct = $this-> createForm(ProductType::class, $product);

        $formProduct->handleRequest($request);

        if($formProduct->isSubmitted()&& $formProduct->isValid())
        {
            $product->setUpdatedAt(new \DateTime());
            
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success','Le produit à été modifié');

            return $this->redirectToRoute('product_index');
        }

        return $this->renderForm('product/edit.html.twig', [
            "action" => "Modifier",
            'formProduct' => $formProduct
        ]);
    
    }


}
