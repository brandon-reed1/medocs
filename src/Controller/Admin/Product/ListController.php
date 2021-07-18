<?php

namespace App\Controller\Admin\Product;

use App\Entity\Line;
use App\Entity\Product;
use App\Form\LineType;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/admin/list", name="admin_line_index")
     */
    public function index(): Response
    {
        $list = $this->em->getRepository(Line::class)
            ->getAllUserLines($this->getUser()->getId());
        return $this->render('admin/product/list/index.html.twig', [
            'list' => $list,
        ]);
    }

    /**
     * @Route("/admin/list/new", name="admin_line_new")
     */
    public function new(Request $request): Response
    {

        $line = new Line();
        $form = $this->createForm(LineType::class, $line);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $line->setUser($this->getUser());
                $this->em->persist($line);
                $this->em->flush();
                $this->addFlash('success', 'Ligne ajouté');

                return $this->redirectToRoute('admin_line_new');

            } catch (ORMException $e) {
                die;
            }
        }

        return $this->render('admin/product/list/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/list/{id}/update",
     *     name="admin_line_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Line $line = null): Response
    {

        if (!$line) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_line_index");
        }

        $form = $this->createForm(LineType::class, $line, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                ;
                $this->em->flush();

                $this->addFlash('success', 'modifié');

                return $this->redirectToRoute("admin_line_index");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }

        return $this->render('admin/product/list/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/list/{id}/delete",
     *     name="admin_line_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Line $line = null): Response
    {

        if (!$line) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_line_index");
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $line->getName() . ' ?'];
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
                    $this->em->remove($line);
//                    $this->getUser()->remove($line);
                    $this->em->flush();

                    $this->addFlash('success', 'supprimé');

                    return $this->redirectToRoute("admin_line_index");

                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->addFlash('notice', 'annulé');

                return $this->redirectToRoute("admin_line_index");

            endif;

        }
        return $this->render('admin/product/list/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]);
    }
}
