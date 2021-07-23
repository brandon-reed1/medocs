<?php

namespace App\Controller\Admin\User;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/profile/update",
     *     name="admin_profile_update",
     *     methods={"GET","PUT"})
     */
    public function updateInfos(Request $request): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('admin_profile_update'),
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            try {
                $this->em->flush();
                $this->addFlash('success', 'modifié');

                return $this->redirectToRoute("admin_index");

            } catch (ORMException $ORMException) {
                die('erreur');
            }
        }
        return $this->render('admin/profile/update-infos.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
