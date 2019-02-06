<?php

namespace App\Controller\Userpanel;
use App\Entity\Admin\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Admin\SettingRepository;
use App\Controller\Admin\UserController;



class UserpanelController extends AbstractController
{
    /**
     * @Route("/", name="userpanel")
     */
    public function index()
    {
        return $this->redirectToRoute('userpanel_show');

    }








    /**
     * @Route("/show", name="userpanel_show")
     */
    public function show()
    {
        return $this->render('userpanel/show.html.twig');

    }


    /**
     * @Route("/edit", name="userpanel_edit", methods="GET|POST")
     */
    public function edit(Request $request)
    {
        $usersession=$this->getUser();
        $user=$this->getDoctrine()
            ->getRepository(User::class)
            ->find($usersession->getid());

        if($request->isMethod('POST'))
        {
            $submittedToken = $request->request->get('token');
            if($this->isCsrfTokenValid('user-form', $submittedToken)){
            $user->setName($request->request->get("name"));
            $user->setPassword($request->request->get("password"));
            $user->setAddress($request->request->get("address"));
            $user->setCity($request->request->get("city"));
            $user->setNumber($request->request->get("number"));
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Başarıyla güncellenmiştir..');
            return $this->redirectToRoute('userpanel_show');
            }
        }
        return $this->render('userpanel/edit.html.twig', ['user'=> $user]);

    }



}

