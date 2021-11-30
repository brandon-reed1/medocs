<?php
/**
 * @author novitz jean-philippe <hello@jphnovitz.be>
 * @copyright 2021-2022
 */

namespace App\Controller\Admin;

use App\Form\ShareListType;
use App\Form\UrlType;
use App\Form\UserType;
use App\Repository\LineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;
use Twig\Extension\AbstractExtension;

class IndexController
{
    private $lineRepository;
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;
    /**
     * @var AbstractExtension
     */
    private $twig;
    /**
     * @var FormFactoryInterface
     */
    private $formBuilder;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var Response
     */
    private $response;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;
    /**
     * @var RouterInterface
     */
    private $router;
    private $user;


    public function __construct(EntityManagerInterface $entityManager,
                                LineRepository $lineRepository,
                                Security $security,
                                FormFactoryInterface $formBuilder,
                                UrlGeneratorInterface $urlGenerator,
                                RouterInterface $router,
                                \Twig\Environment $twig,
                                FlashBagInterface $flashBag)
    {
        $this->lineRepository = $lineRepository;
        $this->user = $security->getUser();
        $this->urlGenerator = $urlGenerator;
        $this->twig = $twig;
        $this->formBuilder = $formBuilder;
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
        $this->router = $router;
    }

    /**
     * @Route("/admin/index", name="admin_index")
     */
    public function index(): Response
    {
        /* @todo dependy injection construct */

        $products = $this->lineRepository->getAllUserLines($this->user);;

        $url_form = $this->formBuilder->create(UrlType::class, null, [
            'action' => $this->urlGenerator->generate('admin_index_url'),
            'method' => 'POST'
        ]);

        $send_form = $this->formBuilder->create(ShareListType::class, null, [
            'action' => $this->urlGenerator->generate('admin_index_send_email'),
            'method' => 'POST'
        ]);


        return new Response($this->twig->render('admin/index.html.twig', [
            'list' => $products,
            'url_form' => $url_form->createView(),
            'send_form' => $send_form->createView()
        ]));
    }

    /**
     * @Route("/admin/url", name="admin_index_url")
     */
    public function updateUrl(Request $request): Response
    {
        $this->user->setUrl($request->request->get('url')['url']);
        $this->entityManager->flush();

        $this->flashBag->add('success', 'url modifiée');
        return  new RedirectResponse($this->router->generate('admin_index'));
    }

    /**
     * @Route("/admin/send", name="admin_index_send_email")
     */
    public function sendMyUrl(MailerInterface $mailer, Request $request): Response
    {
        $lines = $this->lineRepository->getAllUserLines($this->user->getId());

        $email = (new TemplatedEmail())
            ->from('info@medocs.be')
            ->to($request->request->get('share_list')['email'])
            //->cc('cc@medocs.be')
            //->bcc('bcc@medocs.be')
            //->replyTo('fabien@medocs.be')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($this->user->getEmail() . ' vous envoie sa liste de médicaments')
            ->htmlTemplate('emails/list/html-list.html.twig')
//            ->textTemplate('emails/list/text-list.html.twig')
            ->context([
                'list' => $lines
            ]);

        try {
            $mailer->send($email);
            $this->flashBag->add('success', 'email envoyé');
            return new RedirectResponse($this->urlGenerator->generate('admin_index'));
        } catch (TransportExceptionInterface $exception) {
            die('error');
        }
    }

}
