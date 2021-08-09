<?php

namespace App\Controller\Public_;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="public_index")
     */
    public function index(): Response
    {
        return $this->render('public/index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
