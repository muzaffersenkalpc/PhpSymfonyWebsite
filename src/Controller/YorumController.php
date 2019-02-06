<?php

namespace App\Controller;

use App\Entity\Yorum;
use App\Form\YorumType;
use App\Repository\YorumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\HomeController;
use App\Entity\Admin\Product;

/**
 * @Route("/yorum")
 */
class YorumController extends AbstractController
{
    /**
     * @Route("/", name="yorum_index", methods="GET")
     */
    public function index(YorumRepository $yorumRepository): Response
    {
        return $this->render('yorum/index.html.twig', ['yorum' => $yorumRepository->findAll()]);
    }

    /**
     * @Route("/new", name="yorum_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $yorum = new Yorum();
        $form = $this->createForm(YorumType::class, $yorum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($yorum);
            $em->flush();

            return $this->redirectToRoute('yorum_index');
        }

        return $this->render('yorum/new.html.twig', [
            'yorum' => $yorum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="yorum_show", methods="GET")
     */
    public function show(Yorum $yorum): Response
    {

        return $this->render('yorum/show.html.twig', ['yorum' => $yorum]);
    }

    /**
     * @Route("/{id}/edit", name="yorum_edit", methods="GET|POST")
     */
    public function edit(Request $request, Yorum $yorum): Response
    {
        $form = $this->createForm(YorumType::class, $yorum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('yorum_index', ['id' => $yorum->getId()]);
        }

        return $this->render('yorum/edit.html.twig', [
            'yorum' => $yorum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="yorum_delete", methods="DELETE")
     */
    public function delete(Request $request, Yorum $yorum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$yorum->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($yorum);
            $em->flush();
        }

        return $this->redirectToRoute('yorum_index');
    }
}
