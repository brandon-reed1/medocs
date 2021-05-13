<?php

namespace App\Controller\Admin\Dose;

use App\Entity\Dose;
use App\Entity\Moment;
use App\Form\DoseType;
use App\Form\MomentType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        $dose = new Dose();
        $form = $this->createForm(DoseType::class, $dose);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->persist($dose);
                $this->em->flush();

                $this->addFlash('success', 'ajouté');

                return $this->redirectToRoute("admin_dose_index");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/dose/dose/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }



}
