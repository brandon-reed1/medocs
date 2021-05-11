<?php

namespace App\Controller\Admin\Dose;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MomentController extends AbstractController
{
    /**
     * @Route("/admin/dose/moment", name="admin_dose_moment")
     */
    public function index(): Response
    {
        return $this->render('admin/dose/moment/index.html.twig', [
            'controller_name' => 'MomentController',
        ]);
    }
}
