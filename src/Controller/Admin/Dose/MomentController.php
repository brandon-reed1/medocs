<?php

namespace App\Controller\Admin\Dose;

use App\Entity\Moment;
use App\Form\MomentType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MomentController extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/admin/dose/moment", name="admin_dose_moment")
     */
    public function index(): Response
    {
        $list = $this->em->getRepository(Moment::class)
            ->getAll();

        return $this->render('admin/dose/moment/index.html.twig', [
            'list' => $list,
        ]);
    }


    /**
     * @Route("/admin/dose/moment/new",
     *     name="admin_dose_moment_new",
     *     methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {

        $moment = new Moment();
        $form = $this->createForm(MomentType::class, $moment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->persist($moment);
                $this->em->flush();

                $this->addFlash('success', 'ajouté');

                return $this->redirectToRoute("admin_dose_moment");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/dose/moment/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/dose/moment/{id}/update",
     *     name="admin_dose_moment_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Moment $moment): Response
    {

        if (!$moment) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_dose_moment");
        }

        $form = $this->createForm(MomentType::class, $moment, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                ;
                $this->em->flush();

                $this->addFlash('success', 'modifié');

                return $this->redirectToRoute("admin_dose_moment");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/dose/moment/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/dose/moment/{id}/delete",
     *     name="admin_dose_moment_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Moment $moment): Response
    {

        if (!$moment) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_dose_moment");
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $moment->getName() . ' ?'];
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
                    $this->em->remove($moment);
                    $this->em->flush();

                    $this->addFlash('success', 'supprimé');

                    return $this->redirectToRoute("admin_dose_moment");

                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->addFlash('notice', 'annulé');

                return $this->redirectToRoute("admin_dose_moment");

            endif;

        }
        return $this->render('admin/dose/moment/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]);
    }
}
