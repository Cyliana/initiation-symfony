<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test",name="test")   #selectionner le mot Route et clic droit "Import class" et choisir le chemins d'accés avec annotations # 
     */

    public function index()
    {
        return new Response("hello world test! ");
    }

    /**
     * @Route("/test/show",name="test_show")            #Méthode pour indiquer le chemin d'accés avec les annotations#

     */
    public function show()
    {
        $names = ["alexis","thierry","anthony"];

        return $this->render('test/show.html.twig',['age' => 20,'names' => $names]);
    }

     /**
     * @Route("/test/see",name="test-see")
     */
    public function see()
    {
        $ageMore = rand(35,45);

        $ageLess = 25;

        $trainees = 
        [
            ["tom-g",62],
            ["tom-a",53],
            ["thierry",68],
            ["mickael",31],
            ["marc",19],
            ["loic",21],
            ["calvin",16],
            ["anthony",24],
            ["amanda",22],
            ["alexis",35],
        ];

        return $this->render('test/see.html.twig',['trainees' => $trainees, 'ageMore' => $ageMore,'ageLess' => $ageLess,]);
    }

}

 