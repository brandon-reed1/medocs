<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Form\DeleteFormType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class UserController
 * @package App\Controller\Admin\User
 * @Route("/admin/")
 */
class UserController
{
    protected $em;
    protected $encoderFactory;
    protected $passwordEncoder;
    /**
     * @var Security
     */
    private $security;
    /**
     * @var Router
     */
    private $router;
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
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(
        EntityManagerInterface $em,
        EncoderFactoryInterface $encoderFactory,
        UserPasswordEncoderInterface $passwordEncoder,
        Security $security,
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        FlashBagInterface $flashBag,
        \Twig\Environment $twig,
        RequestStack $requestStack, TokenStorageInterface $tokenStorage)
    {
        $this->em = $em;
        $this->encoderFactory = $encoderFactory;
        $this->passwordEncoder = $passwordEncoder;
        $this->security = $security;
        $this->router = $router;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->requestStack = $requestStack;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("profile/update",
     *     name="admin_profile_update",
     *     methods={"GET","PUT"})
     */
    public function updateInfos(Request $request): Response
    {
        $user = $this->security->getUser();

        $form = $this->formFactory->create(UserType::class, null, [
            'action' => $this->router->generate('admin_profile_update'),
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->getData()['email'];
            $plainPassword = $form->getData()['plainPassword'];
            $repeatPassword = $form->getData()['repeatPassword'];
            if (!empty($plainPassword)) {
                if ($plainPassword === $repeatPassword) {
                    $encoder = $this->encoderFactory->getEncoder(new User());
                    if ($encoder->isPasswordValid($user->getPassword(), $form->getData()['oldPassword'], null)) {
                        $user->setPassword(
                            $this->passwordEncoder->encodePassword(
                                $user,
                                $plainPassword
                            )
                        );
                    }
                } else $this->flashBag->add('error', 'les deux mots de passes ne sont pas identiques');
            }

            try {
                $this->em->flush();
                $this->flashBag->add('success', 'modifié');

                return new RedirectResponse($this->router->generate("admin_profile_update"));
            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return new Response($this->twig->render('admin/profile/update-infos.html.twig', [
            'form' => $form->createView()
        ]));
    }

    /**
     * @Route("profile/delete",
     *     name="admin_profile_delete",
     *     methods={"GET", "DELETE"})
     */
    public function delete(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $form = $this->formFactory->create(DeleteFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('yes')->isClicked()) {
                try {
                    if ($user = $this->security->getUser())
                    {
//                        $session = $this->requestStack->getSession();
                        $session = new Session();
                        $session->invalidate();
                        $this->security->getToken()->setAuthenticated(false);
                    }

                    $this->em->remove($user);
                    $this->em->flush();

                    // send email
                    $email = (new TemplatedEmail())
                        ->from('info@medocs.be')
                        ->to($user->getEmail())
                        ->subject('Suppression de votre compte')
                        ->htmlTemplate('emails/user/delete-confirmation.html.twig')
//            ->textTemplate('emails/list/text-list.html.twig')
                        ->context([
                            'details' => $user
                        ]);

                    $mailer->send($email);

                    return new RedirectResponse($this->router->generate("public_index"));
//                    return new RedirectResponse($this->router->generate("public_index"));

                } catch (ORMException $ORMException) {
                    dd($ORMException);
                }
            } else return new RedirectResponse($this->router->generate('admin_profile_update'));
        }
        return new Response($this->twig->render('admin/profile/delete.html.twig', [
            'form' => $form->createView()
        ]));
    }
}
