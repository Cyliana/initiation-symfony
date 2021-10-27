<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
     * @Route("/{id}", name="show", priority = -1)
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
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request)
    {
        $product = new Product();
        $formProduct = $this-> createForm(ProductType::class, $product);
        $formProduct->handleRequest($request);

        if($formProduct->isSubmitted()&& $formProduct->isValid())
        {
            $product->setCreatedAt( new \DateTime());
            $product->setUpdatedAt($product->getCreatedAt());
            
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


}
