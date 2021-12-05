<?php

/**
 * @author novitz jean-philippe <hello@jphnovitz.be>
 * @copyright 2021-2022
 */

namespace App\Controller\Admin\Product;

use App\Entity\Line;
use App\Entity\Product;
use App\Entity\User;
use App\Form\LineType;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;

class ListController 
{
    protected $em;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var \Twig\Environment
     */
    private $twig;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var Security
     */
    private $security;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(EntityManagerInterface $entityManager,
                                ProductRepository $productRepository,
                                UserRepository $userRepository,
                                Security $security,
                                \Twig\Environment $twig,
                                FormFactoryInterface $formFactory,
                                FlashBagInterface $flashBag,
                                RouterInterface $router, 
                                SessionInterface $session)
    {
        $this->em = $entityManager;
        $this->productRepository = $productRepository;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->router = $router;
        $this->security = $security;
        $this->userRepository = $userRepository;
        $this->session = $session;
    }

    /**
     * @Route("/admin/list", name="admin_line_index")
     */
    public function index(): Response
    {
        return new Response ($this->twig->render('admin/product/list/index.html.twig', [
            'list' => $this->productRepository->getAll(),
        ]));
    }

    /**
     * @Route("/admin/list/new", name="admin_line_new")
     */
    public function new(Request $request): Response
    {
        $this->session->get('session')->remove('referer');
        $line = new Line();
        $form = $this->formFactory->create(LineType::class, $line);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {;
                $line->setUser($this->userRepository->findOneBy([
                    'id'=>$this->security->getUser()->getId()
                ]));
                $this->em->persist($line);
                $this->em->flush();
                $this->flashBag->add('success', 'Ligne ajouté');

                return new RedirectResponse($this->router->generate('admin_line_new'));

            } catch (ORMException $e) {
                die;
            }
        }

        return new Response($this->twig->render('admin/product/list/new.html.twig', [
            'form' => $form->createView()
        ]));
    }


    /**
     * @Route("/admin/list/{id}/update",
     *     name="admin_line_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Line $line = null): Response
    {
        if (!$line) {
            $this->flashBag->add('error', 'N\'existe pas');
            return new RedirectResponse($this->router->generate("admin_line_index"));
        }
        $form = $this->formFactory->create(LineType::class, $line, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->flush();
                $this->flashBag->add('success', 'modifié');

                return new RedirectResponse($this->router->generate("admin_line_index"));

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }

        return new Response($this->twig->render('admin/product/list/update.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/admin/list/{id}/delete",
     *     name="admin_line_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Line $line = null): Response
    {
        if (!$line) {
            $this->flashBag->add('error', 'N\'existe pas');
            return new RedirectResponse($this->router->generate("admin_line_index"));
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $line->getName() . ' ?'];
        $form = $this->formFactory->createBuilder(null, $defaultData)
            ->add('yes', SubmitType::class, ['label' => 'Oui Supprimer'])
            ->add('no', SubmitType::class, ['label' => 'Non Annuler'])
            ->setMethod('DELETE')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('yes')->isClicked()):
                try {
                    $this->em->remove($line);
                    $this->em->flush();
                    $this->flashBag->add('success', 'supprimé');
                    return new RedirectResponse($this->router->generate("admin_line_index"));
                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->flashBag->add('notice', 'annulé');

                return new RedirectResponse($this->router->generate("admin_line_index"));
            endif;
        }
        return new Response($this->twig->render('admin/product/list/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]));
    }
}
