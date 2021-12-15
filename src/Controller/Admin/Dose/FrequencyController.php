<?php
/**
 * @author novitz jean-philippe <hello@jphnovitz.be>
 * @copyright 2021-2022
 */

namespace App\Controller\Admin\Dose;


use App\Entity\Frequency;
use App\Form\DeleteFormType;
use App\Form\FrequencyType;
use App\Repository\FrequencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class FrequencyController
{
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
     * @var FrequencyRepository
     */
    private $frequencyRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager,
                                FrequencyRepository $frequencyRepository,
                                \Twig\Environment $twig,
                                FormFactoryInterface $formFactory,
                                FlashBagInterface $flashBag,
                                RouterInterface $router)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->router = $router;
        $this->frequencyRepository = $frequencyRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin/dose/frequency", name="admin_frequency_index")
     */
    public function index(): Response
    {
        return new Response($this->twig->render('admin/dose/frequency/index.html.twig', [
            'list' => $this->frequencyRepository->getAll()
        ]));
    }

    /**
     * @Route("/admin/dose/frequency/new",
     *     name="admin_frequency_new",
     *     methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {
        $frequency = new Frequency();
        $form = $this->formFactory->create(FrequencyType::class, $frequency);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->entityManager->persist($frequency);
                $this->entityManager->flush();

                $this->flashBag->add('success', 'ajouté');

                return new RedirectResponse($this->router->generate("admin_frequency_index"));

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return new Response($this->twig->render('admin/dose/frequency/create.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/admin/dose/frequency/{id}/update",
     *     name="admin_frequency_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Frequency $frequency): Response
    {
        if (!$frequency) {
            $this->flashBag->add('error', 'N\'existe pas');

            return new RedirectResponse($this->router->generate("admin_frequency_index"));
        }

        $form = $this->formFactory->create(FrequencyType::class, $frequency, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                ;
                $this->entityManager->flush();
                $this->flashBag->add('success', 'modifié');

                return new RedirectResponse($this->router->generate("admin_frequency_index"));

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return new Response($this->twig->render('admin/dose/frequency/update.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/admin/dose/frequency/{id}/delete",
     *     name="admin_frequency_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Frequency $frequency): Response
    {

        if (!$frequency) {
            $this->flashBag->add('error', 'N\'existe pas');

            return new RedirectResponse($this->router->generate("admin_frequency_index"));
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $frequency->getName() . ' ?'];
        $form = $this->formFactory->create(DeleteFormType::class, $defaultData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('yes')->isClicked()):
                try {
                    $this->entityManager->remove($frequency);
                    $this->entityManager->flush();
                    $this->flashBag->add('success', 'supprimé');

                    return new RedirectResponse($this->router->generate("admin_frequency_index"));
                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->flashBag->add('notice', 'annulé');
                return new RedirectResponse($this->router->generate("admin_frequency_index"));
            endif;
        }
        return new Response($this->twig->render('admin/dose/frequency/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]));
    }
}
