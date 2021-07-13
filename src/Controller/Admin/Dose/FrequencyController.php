<?php

namespace App\Controller\Admin\Dose;


use App\Entity\Frequency;
use App\Form\FrequencyType;
use App\Repository\FrequencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrequencyController extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/admin/dose/frequency", name="admin_frequency_index")
     */
    public function index(): Response
    {
        $list = $this->em->getRepository(Frequency::class)
            ->getAll();

        return $this->render('admin/dose/frequency/index.html.twig', [
            'list' => $list,
        ]);
    }


    /**
     * @Route("/admin/dose/frequency/new",
     *     name="admin_frequency_new",
     *     methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {

        $frequency = new Frequency();
        $form = $this->createForm(FrequencyType::class, $frequency);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->persist($frequency);
                $this->em->flush();

                $this->addFlash('success', 'ajouté');

                return $this->redirectToRoute("admin_frequency_index");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/dose/frequency/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/dose/frequency/{id}/update",
     *     name="admin_frequency_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Frequency $frequency): Response
    {

        if (!$frequency) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_frequency_index");
        }

        $form = $this->createForm(FrequencyType::class, $frequency, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                ;
                $this->em->flush();

                $this->addFlash('success', 'modifié');

                return $this->redirectToRoute("admin_frequency_index");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/dose/frequency/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/dose/frequency/{id}/delete",
     *     name="admin_frequency_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Frequency $frequency): Response
    {

        if (!$frequency) {
            $this->addFlash('error', 'N\'existe pas');

            return $this->redirectToRoute("admin_frequency_index");
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $frequency->getName() . ' ?'];
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
                    $this->em->remove($frequency);
                    $this->em->flush();

                    $this->addFlash('success', 'supprimé');

                    return $this->redirectToRoute("admin_frequency_index");

                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->addFlash('notice', 'annulé');

                return $this->redirectToRoute("admin_frequency_index");

            endif;

        }
        return $this->render('admin/dose/frequency/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]);
    }
}
