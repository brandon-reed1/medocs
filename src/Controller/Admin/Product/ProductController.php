<?php

/**
 * @author novitz jean-philippe <hello@jphnovitz.be>
 * @copyright 2021-2022
 */

namespace App\Controller\Admin\Product;

use App\Entity\Product;
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

class ProductController 
{
    protected $em;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var Security
     */
    private $security;
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
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->router = $router;
        $this->session = $session;
    }

    /**
     * @Route("/admin/products", name="admin_product_index")
     */
    public function index(): Response
    {
        return new Response ($this->twig->render('admin/product/list/index.html.twig', [
            'list' => $this->productRepository->getAll(),
        ]));
    }

    /**
     * @Route("/admin/product/new", name="admin_product_new")
     */
    public function new(Request $request): Response
    {
        if (!$this->session->get('referer')) {
            $this->session->set('referer', $request->server->get('HTTP_REFERER'));
        }
        $product = new Product();
        $form = $this->formFactory->create(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->persist($product);
                $this->em->flush();
                $this->flashBag->add('success', 'Produit ajouté');

                if ($referer = $this->session->get('referer')) {
                    $this->session->remove('referer');
                    return new RedirectResponse($this->router->generate($referer));
                } else  return new RedirectResponse($this->router->generate('admin_product_new'));

            } catch (ORMException $e) {
                die;
            }
        }

        return new Response($this->twig->render('admin/product/new.html.twig', [
            'form' => $form->createView()
        ]));
    }

    /**
     * @Route("/admin/product/{id}/update",
     *     name="admin_product_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Product $product = null): Response
    {

        if (!$product) {
            $this->flashBag->add('error', 'N\'existe pas');
            return new RedirectResponse($this->router->generate("admin_product_index"));
        }

        $form = $this->formFactory->create(ProductType::class, $product, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->flush();
                $this->flashBag->add('success', 'modifié');
                return new RedirectResponse($this->router->generate("admin_product_index"));

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return new Response($this->twig->render('admin/product/update.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/admin/product/{id}/delete",
     *     name="admin_product_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Product $product = null): Response
    {

        if (!$product) {
            $this->flashBag->add('error', 'N\'existe pas');

            return new RedirectResponse($this->router->generate("admin_product_index"));
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $product->getName() . ' ?'];
        $form = $this->formFactory->createBuilder(null, $defaultData)
            ->add('yes', SubmitType::class, ['label' => 'Oui Supprimer'])
            ->add('no', SubmitType::class, ['label' => 'Non Annuler'])
            ->setMethod('DELETE')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('yes')->isClicked()):
                try {
                    $this->em->remove($product);
                    $this->em->flush();
                    $this->flashBag->add('success', 'supprimé');

                    return new RedirectResponse($this->router->generate("admin_product_index"));

                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->flashBag->add('notice', 'annulé');
                return new RedirectResponse($this->router->generate("admin_product_index"));
            endif;
        }
        return new Response($this->twig->render('admin/product/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]));
    }
}
