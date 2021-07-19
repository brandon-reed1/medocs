<?php

namespace App\Controller\Admin;

use App\Form\ShareListType;
use App\Form\UrlType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/admin/index", name="admin_index")
     */
    public function index(): Response
    {

        /* @todo dependy injection construct */
        $list_size = $this->getDoctrine()->getManager()->getRepository('App:Line')
            ->getCountByUser($this->getUser()->getId());
        $products = $this->getDoctrine()->getManager()->getRepository('App:Line')
            ->getAllUserLines($this->getUser()->getId());;

        $url_form = $this->createForm(UrlType::class, null, [
            'action' => $this->generateUrl('admin_index_url'),
            'method' => 'POST'
        ]);

        $send_form = $this->createForm(ShareListType::class, null, [
            'action' => $this->generateUrl('admin_index_send_email'),
            'method' => 'POST'
        ]);

        return $this->render('admin/index.html.twig', [
            'list_size' => $list_size,
            'list' => $products,
            'url_form' => $url_form->createView(),
            'send_form' => $send_form->createView()
        ]);
    }

    /**
     * @Route("/admin/url", name="admin_index_url")
     */
    public function updateUrl(Request $request): Response
    {
        $this->getUser()->setUrl($request->request->get('url')['url']);
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', 'url modifiée');
        return $this->redirectToRoute('admin_index');
    }

    /**
     * @Route("/admin/send", name="admin_index_send_email")
     */
    public function sendMyUrl(MailerInterface $mailer, Request $request): Response
    {
//        dd($request->request);
        $user = $this->getUser();
        $email = (new Email())
            ->from('hello@example.com')
            ->to($request->request->get('share_list')['email'])
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($user->getEmail() . ' vous envoie sa liste de médicaments')
            ->text('Voici la liste des médicaments que je dois prendre:')
            ->html('<p>TO DO CREATE A LIST</p>');

        try {
            $mailer->send($email);
            $this->addFlash('success', 'email envoyé');
            return $this->redirectToRoute('admin_index');
        } catch (TransportExceptionInterface $exception) {
            die('error');
        }
    }

}
