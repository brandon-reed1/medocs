<?php
/**
 * @author novitz jean-philippe <hello@jphnovitz.be>
 * @copyright 2021-2022
 */
namespace App\Controller\Admin\Dose;

use App\Entity\Dose;
use App\Entity\Moment;
use App\Form\DeleteFormType;
use App\Form\DoseType;
use App\Form\MomentType;
use App\Repository\DoseRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class DoseController
{
    protected $em;
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
     * @var DoseRepository
     */
    private $doseRepository;
    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager,
                                DoseRepository $doseRepository,
                                \Twig\Environment $twig,
                                FormFactoryInterface $formFactory,
                                FlashBagInterface $flashBag,
                                RouterInterface $router,
                                RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->router = $router;
        $this->doseRepository = $doseRepository;
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/admin/dose", name="admin_dose_index")
     */
    public function index(): Response
    {
        return new Response ($this->twig->render('admin/dose/dose/index.html.twig', [
            'list' => $this->doseRepository->getAll(),
        ]));
    }


    /**
     * @Route("/admin/dose/new",
     *     name="admin_dose_new",
     *     methods={"GET", "POST"})
     */
    public function create(Request $request, SessionInterface $session): Response
    {

        if (!$this->requestStack->getCurrentRequest()->getSession()->get('referer')){
            $this->requestStack->getCurrentRequest()->getSession()->set('referer', $request->server->get('HTTP_REFERER'));
        }

        $dose = new Dose();
        $form = $this->formFactory->create(DoseType::class, $dose);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->persist($dose);
                $this->em->flush();

                $this->flashBag->add('success', 'ajouté');

                if ($referer = $this->requestStack->getCurrentRequest()->getSession()->get('referer')) {
                    $this->requestStack->getCurrentRequest()->getSession()->remove('referer');
                    return new RedirectResponse($referer);
                } else  return new RedirectResponse($this->router->generate('admin_dose_new'));


            } catch (Exception $exception) {
                die('erreur');
            }
        }
        return new Response($this->twig->render('admin/dose/dose/new.html.twig', [
            'form' => $form->createView(),
        ]));
    }


    /**
     * @Route("/admin/dose/{id}/update",
     *     name="admin_dose_update",
     *     methods={"GET", "PUT"})
     */
    public function update(Request $request, Dose $dose): Response
    {
        if (!$dose) {
            $this->flashBag->add('error', 'N\'existe pas');

            return new Response($this->router->generate("admin_dose_index"));
        }

        $form = $this->formFactory->create(DoseType::class, $dose, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                ;
                $this->em->flush();

                $this->flashBag->add('success', 'modifié');

                return new Response($this->router->generate("admin_dose_index"));

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return new Response($this->twig->render('admin/dose/dose/update.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/admin/dose/{id}/delete",
     *     name="admin_dose_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Dose $dose): Response
    {
        if (!$dose) {
            $this->flashBag->add('error', 'N\'existe pas');

            return new Response($this->router->generate("admin_dose_index"));
        }

        $defaultData = ['message' => 'Voulez vous effacer ' . $dose . ' ?'];

        $form = $this->formFactory->create(DeleteFormType::class,  $defaultData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('yes')->isClicked()):
                try {
                    $this->em->remove($dose);
                    $this->em->flush();

                    $this->flashBag->add('success', 'supprimé');
                    return new RedirectResponse($this->router->generate("admin_dose_index"));

                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->flashBag->add('notice', 'annulé');
                return new RedirectResponse($this->router->generate("admin_dose_index"));
            endif;
        }
        return new Response($this->twig->render('admin/dose/dose/delete.html.twig', [
            'form' => $form->createView()
        ]));
    }


}
