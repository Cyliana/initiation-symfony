<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;


class HomeController
{
    public function index()
    {
        return new Response("hello world home ! ");
    }

    public function show()
    {
        return new Response("hello world deux ! ");
    }
}
