<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    protected $em;
    protected $encoderFactory;
    protected $passwordEncoder;

    public function __construct(EntityManagerInterface $em, EncoderFactoryInterface $encoderFactory, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->em = $em;
        $this->encoderFactory = $encoderFactory;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/profile/update",
     *     name="admin_profile_update",
     *     methods={"GET","PUT"})
     */
    public function updateInfos(Request $request): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, null, [
            'action' => $this->generateUrl('admin_profile_update'),
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
                } else $this->addFlash('error', 'les deux mots de passes ne sont pas identiques');
            }

            try {
                $this->em->flush();
                $this->addFlash('success', 'modifié');

                return $this->redirectToRoute("admin_index");
            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/profile/update-infos.html.twig', ['form' => $form->createView(),]);
    }
}
