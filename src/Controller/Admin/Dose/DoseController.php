<?php

namespace App\Controller\Admin\Dose;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoseController extends AbstractController
{
    /**
     * @Route("/admin/dose/dose", name="admin_dose_dose")
     */
    public function index(): Response
    {
        return $this->render('admin/dose/dose/index.html.twig', [
            'controller_name' => 'DoseController',
        ]);
    }
}
