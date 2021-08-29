<?php

namespace App\Controller\Admin\Product;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/admin/products", name="admin_product_index")
     */
    public function index(): Response
    {
        $list = $this->em->getRepository(Product::class)
            ->getAll();

        return $this->render('admin/product/index.html.twig', [
            'list' => $list,
        ]);
    }

    /**
     * @Route("/admin/product/new", name="admin_product_new")
     */
    public function new(Request $request): Response
    {
        if (!$this->get('session')->get('referer')) {
            $this->get('session')->set('referer', $request->server->get('HTTP_REFERER'));
        }
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            try {
                $this->em->persist($product);
                $this->em->flush();
                $this->addFlash('success', 'Produit ajouté');

                if ($referer = $this->get('session')->get('referer')) {
                    $this->get('session')->remove('referer');

                    return $this->redirect($referer);
                } else  return $this->redirectToRoute('admin_product_new');

            } catch (ORMException $e) {
                die;
            }
        }

        return $this->render('admin/product/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/product/{id}/update",
     *     name="admin_product_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Product $product = null): Response
    {

        if (!$product) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_product_index");
        }

        $form = $this->createForm(ProductType::class, $product, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                ;
                $this->em->flush();

                $this->addFlash('success', 'modifié');

                return $this->redirectToRoute("admin_product_index");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/product/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/product/{id}/delete",
     *     name="admin_product_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Product $product = null): Response
    {

        if (!$product) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_product_index");
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $product->getName() . ' ?'];
        $form = $this->createFormBuilder($defaultData)
            ->add('yes', SubmitType::class, [
                'label' => 'Oui Supprimer'
            ])
            ->add('no', SubmitType::class, [
                'label' => 'Non Annuler'
            ])
            ->setMethod('DELETE')
            ->getForm();
//dd($form->getData());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('yes')->isClicked()):
                try {
                    $this->em->remove($product);
                    $this->em->flush();

                    $this->addFlash('success', 'supprimé');

                    return $this->redirectToRoute("admin_product_index");

                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->addFlash('notice', 'annulé');

                return $this->redirectToRoute("admin_product_index");

            endif;

        }
        return $this->render('admin/product/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]);
    }
}
