<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/admin/index", name="admin_index")
     */
    public function index(): Response
    {

        $list_size = $this->getDoctrine()->getManager()->getRepository('App:Line')->getCount();
        $products = $this->getDoctrine()->getManager()->getRepository('App:Line')->getAll();
        return $this->render('admin/index.html.twig', [
            'list_size' => $list_size,
            'list' => $products
        ]);
    }
}
