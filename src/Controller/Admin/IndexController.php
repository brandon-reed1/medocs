<?php

namespace App\Controller\Admin;

use App\Form\UrlType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            'action'=>$this->generateUrl('admin_index_url'),
            'method' => 'POST'
        ])
        ;

        return $this->render('admin/index.html.twig', [
            'list_size' => $list_size,
            'list' => $products,
            'url_form' => $url_form->createView()
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
}
