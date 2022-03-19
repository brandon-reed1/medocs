<?php

namespace App\Controller\Public_;

use App\Entity\Line;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;

class IndexController
{
    /**
     * @var Security
     */
    private $security;
    /**
     * @var \Twig\Environment
     */
    private $twig;
    /**
     * @var Router
     */
    private $router;

    public function __construct(Security $security,
                                \Twig\Environment $twig,
                                RouterInterface $router)
    {
        $this->security = $security;
        $this->twig = $twig;
        $this->router = $router;
    }

    /**
     * @Route("/", name="public_index")
     */
    public function index(): Response
    {
        if ($this->security->getUser()) {
            return new RedirectResponse($this->router->generate('admin_index'));
        }
        return new Response($this->twig->render('public/index/index.html.twig'));
    }

    /**
     * @Route("/g/{slug}", name="public_page")
     */
    public function publicUrl(User $user): Response
    {
        return new Response($this->twig->render('public/index/list.html.twig', [
            'list' => $user->getLines(),
        ]));
    }


    /**
     * @Route("/condition-utilisation", name="public_condition_use_fr")
     */
    public function condition_use(): Response
    {
        return new Response($this->twig->render('public/index/conditions-use_fr.html.twig'));
    }

    /**
     * @Route("/foire-aux-questions", name="public_faq_fr")
     */
    public function faq(): Response
    {
        return new Response($this->twig->render('public/index/faq_fr.html.twig'));
    }

}
