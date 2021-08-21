<?php

namespace App\Controller\Admin\Dose;

use App\Entity\Day;
use App\Form\DayType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DayController extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/admin/dose/days", name="admin_day_index")
     */
    public function index(): Response
    {
        $list = $this->em->getRepository(Day::class)
            ->getAll();

        return $this->render('admin/dose/day/index.html.twig', [
            'list' => $list,
        ]);
    }


    /**
     * @Route("/admin/dose/day/new",
     *     name="admin_day_new",
     *     methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {

        $day = new Day();
        $form = $this->createForm(DayType::class, $day);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->persist($day);
                $this->em->flush();

                $this->addFlash('success', 'ajouté');

                return $this->redirectToRoute("admin_day_index");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/dose/day/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/dose/day/{id}/update",
     *     name="admin_day_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Day $day): Response
    {

        if (!$day) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_day_index");
        }

        $form = $this->createForm(DayType::class, $day, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                ;
                $this->em->flush();

                $this->addFlash('success', 'modifié');

                return $this->redirectToRoute("admin_day_index");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/dose/day/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/dose/day/{id}/delete",
     *     name="admin_day_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Day $day): Response
    {

        if (!$day) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_day_index");
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $day->getName() . ' ?'];
        $form = $this->createFormBuilder($defaultData)
            ->add('yes', SubmitType::class)
            ->add('no', SubmitType::class)
            ->setMethod('DELETE')
            ->getForm();
//dd($form);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('yes')->isClicked()):
                try {
                    $this->em->remove($day);
                    $this->em->flush();

                    $this->addFlash('success', 'supprimé');

                    return $this->redirectToRoute("admin_day_index");

                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->addFlash('notice', 'annulé');

                return $this->redirectToRoute("admin_day_index");

            endif;

        }
        return $this->render('admin/dose/day/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]);
    }
}
