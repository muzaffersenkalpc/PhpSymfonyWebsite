<?php

namespace App\Controller\Admin;

use App\Entity\Admin\User;
use App\Form\Admin\UserType;
use App\Repository\Admin\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/users")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="admin_users_index", methods="GET")
     */
    public function index()
    {
        $user=$this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        return $this->render('admin/users/index.html.twig', ['users' => $user,
            ]);
    }

    /**
     * @Route("/new", name="admin_users_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_users_index');
        }


        return $this->render('admin/users/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_users_show", methods="GET")
     */
    public function show(User $user): Response
    {
        return $this->render('admin/users/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/admin/users/edit/{id}", name="admin_users_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_users_index');
        }

        return $this->render('admin/users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="admin_users_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('admin_users_index');
    }
}
