<?php
/**
 * @author novitz jean-philippe <hello@jphnovitz.be>
 * @copyright 2021-2022
 */
namespace App\Controller\Admin\Dose;

use App\Entity\Moment;
use App\Form\DeleteFormType;
use App\Form\MomentType;
use App\Repository\MomentRepository;
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

class MomentController
{
    protected $em;
    /**
     * @var MomentRepository
     */
    private $momentRepository;
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

    public function __construct(EntityManagerInterface $entityManager,
                                MomentRepository $momentRepository,
                                \Twig\Environment $twig,
                                FormFactoryInterface $formFactory,
                                FlashBagInterface $flashBag,
                                RouterInterface $router)
    {
        $this->em = $entityManager;
        $this->momentRepository = $momentRepository;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->router = $router;
    }

    /**
     * @Route("/admin/dose/moments", name="admin_moment_index")
     */
    public function index(): Response
    {
        return new Response ($this->twig->render('admin/dose/moment/index.html.twig', [
            'list' => $this->momentRepository->getAll(),
        ]));
    }


    /**
     * @Route("/admin/dose/moment/new",
     *     name="admin_moment_new",
     *     methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {

        $moment = new Moment();
        $form = $this->formFactory->create(MomentType::class, $moment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->persist($moment);
                $this->em->flush();

                $this->flashBag->add('success', 'ajouté');

                return new RedirectResponse($this->router->generate("admin_moment_index"));

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return new Response ($this->twig->render('admin/dose/moment/create.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/admin/dose/moment/{id}/update",
     *     name="admin_moment_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Moment $moment): Response
    {

        if (!$moment) {
            $this->flashBag->add('error', 'N\'existe pas');

            return new RedirectResponse($this->router->generate("admin_moment_index"));
        }

        $form = $this->formFactory->create(MomentType::class, $moment, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                ;
                $this->em->flush();

                $this->flashBag->add('success', 'modifié');

                return new RedirectResponse($this->router->generate("admin_moment_index"));

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return new Response ($this->twig->render('admin/dose/moment/update.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/admin/dose/moment/{id}/delete",
     *     name="admin_moment_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Moment $moment): Response
    {

        if (!$moment) {
            $this->flashBag->add('error', 'N\'existe pas');

            return new RedirectResponse($this->router->generate("admin_moment_index"));
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $moment->getName() . ' ?'];
        $form = $this->formFactory->create(DeleteFormType::class, $defaultData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('yes')->isClicked()):
                try {
                    $this->em->remove($moment);
                    $this->em->flush();
                    $this->flashBag->add('success', 'supprimé');

                    return new RedirectResponse($this->router->generate("admin_moment_index"));
                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->flashBag->add('notice', 'annulé');
                return new RedirectResponse($this->router->generate("admin_moment_index"));
            endif;
        }
        return new Response ($this->twig->render('admin/dose/moment/delete.html.twig', [
            'form' => $form->createView()
        ]));
    }
}
