<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AboutController
{
    /**
     * @Route("/about",name="about")
     */
    public function index()
    {
        return new Response("hello world ! ");
    }
    
}
