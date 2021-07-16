<?php

namespace App\Controller\Admin\Dose;

use App\Entity\Dose;
use App\Entity\Moment;
use App\Form\DoseType;
use App\Form\MomentType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoseController extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/admin/dose", name="admin_dose_index")
     */
    public function index(): Response
    {
        $list = $this->em->getRepository(Dose::class)
            ->getAll();

        return $this->render('admin/dose/dose/index.html.twig', [
            'list' => $list,
        ]);
    }


    /**
     * @Route("/admin/dose/new",
     *     name="admin_dose_new",
     *     methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {
        if (!$this->get('session')->get('referer')) {
            $this->get('session')->set('referer', $request->server->get('HTTP_REFERER'));
        }
        $dose = new Dose();
        $form = $this->createForm(DoseType::class, $dose);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                //dd($dose);
                $this->em->persist($dose);
                $this->em->flush();

                $this->addFlash('success', 'ajouté');

                if ($referer = $this->get('session')->get('referer')) {
                    $this->get('session')->remove('referer');
                    return $this->redirect($referer);
                } else  return $this->redirectToRoute('admin_product_new');

//                return $this->redirectToRoute("admin_dose_index");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/dose/dose/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/dose/{id}/update",
     *     name="admin_dose_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Dose $dose): Response
    {

        if (!$dose) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_dose_index");
        }

        $form = $this->createForm(DoseType::class, $dose, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                ;
                $this->em->flush();

                $this->addFlash('success', 'modifié');

                return $this->redirectToRoute("admin_dose_index");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/dose/dose/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/dose/{id}/delete",
     *     name="admin_dose_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Dose $dose): Response
    {

        if (!$dose) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_dose_index");
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $dose . ' ?'];
        $form = $this->createFormBuilder($defaultData)
            ->add('oui', SubmitType::class)
            ->add('non', SubmitType::class)
            ->setMethod('DELETE')
            ->getForm();
//dd($form);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('oui')->isClicked()):
                try {
                    $this->em->remove($dose);
                    $this->em->flush();

                    $this->addFlash('success', 'supprimé');

                    return $this->redirectToRoute("admin_dose_index");

                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->addFlash('notice', 'annulé');

                return $this->redirectToRoute("admin_dose_index");

            endif;

        }
        return $this->render('admin/dose/dose/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]);
    }


}
