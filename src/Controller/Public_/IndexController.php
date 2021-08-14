<?php

namespace App\Controller\Public_;

use App\Entity\Line;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

    /**
     * @Route("/g/{url}", name="public_page")
     */
    public function publicUrl(User $user): Response
    {

        return $this->render('public/index/list.html.twig', [
            'list' => $user->getLines(),
        ]);
    }
}
