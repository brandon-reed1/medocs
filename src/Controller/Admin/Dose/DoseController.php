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
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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

    public function __construct(EntityManagerInterface $entityManager,
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
    }

    /**
     * @Route("/admin/dose", name="admin_dose_index")
     */
    public function index(): Response
    {
        $list = $this->em->getRepository(Dose::class)
            ->getAll();

        return new Response($this->twig->render('admin/dose/dose/index.html.twig', [
                'list' => $list,
            ]));
    }


    /**
     * @Route("/admin/dose/new",
     *     name="admin_dose_new",
     *     methods={"GET", "POST"})
     */
    public function create(Request $request, SessionInterface $session): Response
    {
        if (!$session->get('session')->get('referer')) {
            $session->get('session')->set('referer', $request->server->get('HTTP_REFERER'));
        }
        $dose = new Dose();
        $form = $this->formFactory->create(DoseType::class, $dose);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->persist($dose);
                $this->em->flush();

                $this->flashBag->add('success', 'ajouté');

                if ($referer = $session->get('session')->get('referer')) {
                    $session->get('session')->remove('referer');
                    return new RedirectResponse($this->router->generate($referer));
                } else  return new RedirectResponse($this->router->generate('admin_dose_new'));


            } catch (ORMException $ORMException) {
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
        $form = $this->formFactory->createBuilder(null, $defaultData)
            ->add('yes', SubmitType::class)
            ->add('no', SubmitType::class)
            ->setMethod('DELETE')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('yes')->isClicked()):
                try {
                    $this->em->remove($dose);
                    $this->em->flush();

                    $this->flashBag->add('success', 'supprimé');
                    return new Response($this->router->generate("admin_dose_index"));

                } catch (ORMException $ORMException) {
                    die('erreur');
                }
            else:
                $this->flashBag->add('notice', 'annulé');
                return new Response($this->router->generate("admin_dose_index"));
            endif;
        }
        return new Response($this->twig->render('admin/dose/dose/delete.html.twig', [
            'form' => $form->createView(),
            'default_data' => $defaultData
        ]));
    }


}
