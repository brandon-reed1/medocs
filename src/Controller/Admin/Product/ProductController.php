<?php

namespace App\Controller\Admin\Product;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $manager){
        $this->em = $manager;
    }


    /**
     * @Route("/admin/productd", name="admin_products_list")
     */
    public function index(): Response
    {
        return $this->render('admin/product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/admin/product/new", name="admin_product_new")
     */
    public function new(Request $request): Response
    {

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
           try {
               $this->em->persist($product);
               $this->em->flush();
               $this->addFlash('success', 'Produit ajouté');

               return $this->redirectToRoute('admin_product_new');

           }catch(ORMException $e){
               die;
           }
        }

        return $this->render('admin/product/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
