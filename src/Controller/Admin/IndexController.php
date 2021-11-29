<?php

namespace App\Controller\Admin;

use App\Form\ShareListType;
use App\Form\UrlType;
use App\Form\UserType;
use App\Repository\LineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class IndexController extends AbstractController
{
    private $lineRepository;

    public function __construct(LineRepository $lineRepository){
        $this->lineRepository = $lineRepository;
    }

    /**
     * @Route("/admin/index", name="admin_index")
     */
    public function index(): Response
    {
        /* @todo dependy injection construct */

        $list_size = $this->lineRepository->getCountByUser($this->getUser()->getId());
        $products = $this->lineRepository->getAllUserLines($this->getUser()->getId());;

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
        $user = $this->getUser();
        $lines = $this->getDoctrine()->getManager()->getRepository('App:Line')
            ->getAllUserLines($this->getUser()->getId());

        $email = (new TemplatedEmail())
            ->from('info@medocs.be')
            ->to($request->request->get('share_list')['email'])
            //->cc('cc@medocs.be')
            //->bcc('bcc@medocs.be')
            //->replyTo('fabien@medocs.be')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($user->getEmail() . ' vous envoie sa liste de médicaments')
            ->htmlTemplate('emails/list/html-list.html.twig')
//            ->textTemplate('emails/list/text-list.html.twig')
        ->context([
            'list'=> $lines
        ]);

        try {
            $mailer->send($email);
            $this->addFlash('success', 'email envoyé');
            return $this->redirectToRoute('admin_index');
        } catch (TransportExceptionInterface $exception) {
            die('error');
        }
    }

}
