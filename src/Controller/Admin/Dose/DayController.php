<?php
/**
 * @author novitz jean-philippe <hello@jphnovitz.be>
 * @copyright 2021-2022
 */
namespace App\Controller\Admin\Dose;

use App\Entity\Day;
use App\Form\DayType;
use App\Form\DeleteFormType;
use App\Repository\DayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class DayController{
    protected $em;
    /**
     * @var \Twig\Environment
     */
    private $twig;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    private $flashBag;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var DayRepository
     */
    private $dayRepository;

    public function __construct(EntityManagerInterface $entityManager,
                                DayRepository $dayRepository,
                                \Twig\Environment $twig,
                                FormFactoryInterface $formFactory,
                                FlashBagInterface $flashBag,
                                RouterInterface $router)
    {
        $this->em = $entityManager;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->router = $router;
        $this->dayRepository = $dayRepository;
    }

    /**
     * @Route("/admin/dose/days", name="admin_day_index")
     */
    public function index(): Response
    {
        return new Response ($this->twig->render('admin/dose/day/index.html.twig', [
            'list' => $this->dayRepository->getAll(),
        ]));
    }


    /**
     * @Route("/admin/dose/day/new",
     *     name="admin_day_new",
     *     methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {

        $day = new Day();
        $form = $this->formFactory->create(DayType::class, $day);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->persist($day);
                $this->em->flush();

                $this->flashBag->add('success', 'ajouté');

                return new RedirectResponse($this->router->generate("admin_day_index"));

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return new RedirectResponse($this->twig->render('admin/dose/day/create.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/admin/dose/day/{id}/update",
     *     name="admin_day_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Day $day): Response
    {

        if (!$day) {
            $this->flashBag->add('error', 'N\'existe pas');

            return new RedirectResponse($this->router->generate("admin_day_index"));
        }

        $form = $this->formFactory->create(DayType::class, $day, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                ;
                $this->em->flush();

                $this->flashBag->add('success', 'modifié');

                return new RedirectResponse($this->router->generate("admin_day_index"));

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return new RedirectResponse($this->twig->render('admin/dose/day/update.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/admin/dose/day/{id}/delete",
     *     name="admin_day_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Day $day): Response
    {
        if (!$day) {
            $this->flashBag->add('error', 'N\'existe pas');
            return new RedirectResponse($this->router->generate("admin_day_index"));
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $day->getName() . ' ?'];

        $form = $this->formFactory->create(DeleteFormType::class, $defaultData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('yes')->isClicked()):
                try {
                    $this->em->remove($day);
                    $this->em->flush();
                    $this->flashBag->add('success', 'supprimé');

                    return new RedirectResponse($this->router->generate("admin_day_index"));

                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->flashBag->add('notice', 'annulé');
                return new RedirectResponse($this->router->generate("admin_day_index"));
            endif;

        }
        return new RedirectResponse($this->twig->render('admin/dose/day/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]));
    }
}
