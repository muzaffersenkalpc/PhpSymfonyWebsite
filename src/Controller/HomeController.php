<?php

namespace App\Controller;
use App\Entity\Admin\Messages;
use App\Entity\Yorum;
use App\Entity\Admin\User;
use App\Form\Admin\UserType;
use App\Repository\Admin\UserRepository;
use App\Repository\Admin\ImageRepository;
use App\Repository\YorumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Admin\SettingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\ProductRepository;
use App\Form\Admin\MessagesType;
use App\Entity\Orders;
use App\Controller\YorumController;
use App\Form\YorumType;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SettingRepository $settingRepository, CategoryRepository $categoryRepository)
    {
        $data= $settingRepository->findAll();
        $cats=$this->categorytree();

        $em=$this->getDoctrine()->getManager();
        $sql = "SELECT * FROM product WHERE status='True' ORDER BY ID DESC LIMIT 3";
        $sql1 = "SELECT * FROM product WHERE status='True' ORDER BY RAND() LIMIT 1";
        $sql2 = "SELECT * FROM product WHERE status='True' ORDER BY RAND() LIMIT 1";  //template kabul etmediğinden dolayı değişik sql kodları lazımdı..
        $sql3 = "SELECT * FROM product WHERE status='True' ORDER BY RAND() LIMIT 1";
        $sql4 = "SELECT * FROM product WHERE status='True' ORDER BY RAND() LIMIT 1";
        $sql5 = "SELECT * FROM product WHERE status='True' ORDER BY RAND() LIMIT 1";
        $sql6 = "SELECT * FROM product WHERE status='True' ORDER BY RAND() LIMIT 1";
        $sql7 = "SELECT * FROM product WHERE status='True' ORDER BY RAND() LIMIT 3";
        $statement = $em->getConnection()->prepare($sql);
        $statement1 = $em->getConnection()->prepare($sql1);
        $statement2 = $em->getConnection()->prepare($sql2);
        $statement3 = $em->getConnection()->prepare($sql3);
        $statement4 = $em->getConnection()->prepare($sql4);
        $statement5 = $em->getConnection()->prepare($sql5);
        $statement6 = $em->getConnection()->prepare($sql6);
        $statement7 = $em->getConnection()->prepare($sql7);
        //$statement->bindValue('pid',$parent);
        $statement->execute();
        $statement1->execute();
        $statement2->execute();
        $statement3->execute();
        $statement4->execute();
        $statement5->execute();
        $statement6->execute();
        $statement7->execute();
        $sliders=$statement->fetchAll();
        $sliders1=$statement1->fetchAll();
        $sliders2=$statement2->fetchAll();
        $sliders3=$statement3->fetchAll();
        $sliders4=$statement4->fetchAll();
        $sliders5=$statement5->fetchAll();
        $sliders6=$statement6->fetchAll();
        $sliders7=$statement7->fetchAll();
        //dump($cats);
        //print_r($cats);
        //die();
        $cats[0]='<ul id="menu-v">';

        return $this->render('home/index.html.twig', [
            'data' => $data,
            'cats' => $cats,
            'sliders'=>$sliders,
            'sliders1'=> $sliders1,
            'sliders2'=> $sliders2,
            'sliders3'=> $sliders3,
            'sliders4'=> $sliders4,
            'sliders5'=> $sliders5,
            'sliders6'=> $sliders6,
            'sliders7'=> $sliders7,//rand 6 tane üretiyor
        ]);
    }
    //recursive fonksiyon kategori agaci için
    public function categorytree($parent = 0, $user_tree_array = ''){


        if(!is_array($user_tree_array))
            $user_tree_array = array();

        $em=$this->getDoctrine()->getManager();
        $sql = "SELECT * FROM category WHERE status='True' AND parentid=".$parent;
        $statement = $em->getConnection()->prepare($sql);
        //$statement->bindValue('pid',$parent);
        $statement->execute();
        $result=$statement->fetchAll();



        if(count($result)>0){
            $user_tree_array[]="<ul>";
            foreach($result as $row){
                $user_tree_array[] = "<li> <a href='/category/".$row['id']."' >". $row['title']."</a>";
                $user_tree_array = $this->categorytree($row['id'], $user_tree_array);
            }
            $user_tree_array[] = "</li></ul>";
        }
        return $user_tree_array;
    }
    /**
     * @Route("category/{catid}", name="category_products", methods="GET|POST")
     */
    public function CategoryProducts($catid,CategoryRepository $categoryRepository)
    {
        $cats = $this->categorytree();
        $cats[0] = '<ul id="menu-v">';
        $data = $categoryRepository->findBy([
            'id' => $catid
        ]);
        //dump($data);
        $em = $this->getDoctrine()->getManager();
        $sql = 'SELECT * FROM product WHERE status="True" AND category_id= :catid';
        $statement = $em->getConnection()->prepare($sql);
        $statement->bindValue('catid', $catid);
        $statement->execute();
        $product = $statement->fetchAll();
        //dump($result);
        //die();
        return $this->render('home/products.html.twig', [
            'data' => $data,
            'product' => $product,
            'cats' => $cats,
        ]);
    }
        /**
         * @Route("/product/{id}", name="product_detail", methods="GET")
         */
        public function ProductDetail($id,YorumRepository $yorumRepository, ProductRepository $productRepository, ImageRepository $imageRepository)
    {
        $data = $productRepository->findBy([
            'id'=>$id
        ]);
        $images=$imageRepository->findBy([
            'product_id'=>$id,
        ]);

        $cats=$this->categorytree();

        $cats[0]='<ul id="menu-v">';

        $dataa = $yorumRepository->findBy([
            'productid'=>$id
        ]);


        $em=$this->getDoctrine()->getManager();

        $sql = "SELECT * FROM yorum WHERE  productid=".$id;
        $statement = $em->getConnection()->prepare($sql);
        $statement->bindValue('id', $id);
        $statement->execute();


        //die();
        return $this->render('home/product_detail.html.twig', [
            'data' => $data,
            'cats'=> $cats,
            'images'=> $images,
            'dataa' => $dataa,

        ]);

    }
    /**
     * @Route("/product/control{id}", name="control_product_detail", methods="GET")
     */
    public function controlProductDetail($id,YorumRepository $yorumRepository, ProductRepository $productRepository, ImageRepository $imageRepository)
    {
        $data = $productRepository->findBy([
            'id'=>$id
        ]);
        $images=$imageRepository->findBy([
            'product_id'=>$id,
        ]);

        $cats=$this->categorytree();

        $cats[0]='<ul id="menu-v">';

        $dataa = $yorumRepository->findBy([
            'productid'=>$id
        ]);


        $em=$this->getDoctrine()->getManager();

        $sql = "SELECT * FROM yorum WHERE  productid=".$id;
        $statement = $em->getConnection()->prepare($sql);
        $statement->bindValue('id', $id);
        $statement->execute();


        //die();
        return $this->render('home/controlproduct_detail.html.twig', [
            'data' => $data,
            'cats'=> $cats,
            'images'=> $images,
            'dataa' => $dataa,

        ]);

    }

    /**
     * @Route("/hakkimizda", name="hakkimizda")
     */
    public function hakkimizda(SettingRepository $settingRepository)
    {
        $data = $settingRepository->findAll();
        return $this->render('home/hakkimizda.html.twig', [
            'data' => $data,
        ]);
    }

        /**
         * @Route("/referanslar", name="referanslar")
         */
        public
        function referanslar(SettingRepository $settingRepository)
        {
            $data = $settingRepository->findAll();
            return $this->render('home/referanslar.html.twig', [
                'data' => $data,
            ]);

        }


    /**
     * @Route("/iletisim", name="iletisim", methods="GET|POST")
     */
    public function iletisim(SettingRepository $settingRepository, Request $request)
    {
        $message = new Messages();
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);
        $submittedToken = $request->request->get('token');

        if ($form->isSubmitted()) {
            if($this->isCsrfTokenValid('form-message', $submittedToken)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            $this->addFlash('success','Mesaj Başarıyla Gönderilmiştir.');
            return $this->redirectToRoute('iletisim');
            }
        }

        $data= $settingRepository->findAll();
        return $this->render('home/iletisim.html.twig',[
            'data' => $data,
            'message'=>$message,
            'form' => $form->createView()
        ]);

    }
    /**
     * @Route("/product/{id}", name="yorum", methods="GET|POST")
     */
    public function yorum($id,$name='a', userRepository $userRepository, yorumRepository $yorumRepository, ProductRepository $productRepository, Request $request)
    {



        $data = $productRepository->findBy([
            'id'=>$id
        ]);

        $usersession=$this->getUser();

        if($usersession!=NULL){              /* yorum yaparken üye mi kontrol ediliyor*/
        $user=$this->getDoctrine()
            ->getRepository(User::class)
            ->find($usersession->getId());
        $name=$usersession->getName();

        }
        else
            return $this->redirectToRoute('app_login');

        $yorum = new Yorum();
        $form = $this->createForm(YorumType::class, $yorum);
        $form->handleRequest($request);
        $submittedToken = $request->request->get('token');


        if ($form->isSubmitted()) {
            if($this->isCsrfTokenValid('form-yorum', $submittedToken)) {
                $em = $this->getDoctrine()->getManager();
                $yorum->setName($name);
                $em->persist($yorum);
                $yorum->setproductid($id);  //daha sonra productid ye göre yorumları göstereceğimizden setproductid ye id attık.
                $em->flush();

                $this->addFlash('success', 'Yorumunuz Başarıyla Gönderilmiştir.');
                return $this->redirectToRoute('yorum', ['id' => $id]); //product[id} ye döndürmek için id gerekli.5 saat bu sorunu çözmemle geçti.

            }

        }


        $dataa= $yorumRepository->findAll();

        return $this->render('home/product_detail.html.twig',[
            'data' => $data,
            'yorum'=>$yorum,
            'dataa'=>$dataa,
            'user'=> $user,
            'form' => $form->createView()


        ]);

    }
    /**
     * @Route("/product/{id}", name="yorum_show", methods="GET")
     */
   /* public function yorumshow($id,Yorum $yorum): Response
    {


        $data = $productRepository->findBy([
            'id'=>$id
        ]);

        $em=$this->getDoctrine()->getManager();
        $sql = "SELECT * FROM category WHERE status='True' AND productid=".$data;
        $statement = $em->getConnection()->prepare($sql);
        $statement->bindValue('id', $id);
        $statement->execute();
        return $this->render('yorum/show.html.twig', ['yorum' => $yorum]);
    }*/

    /**
     * @Route("/newuser", name="new_user", methods="GET|POST")
     */
    public function newuser(Request $request,UserRepository $userRepository): Response
    {

        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);


        $submittedToken = $request->request->get('token');


        if ($this->isCsrfTokenValid('user-form', $submittedToken)) {
            if ($form->isSubmitted()) {

                 $emaildata=$userRepository->findBy([
                     'email' =>$user->getEmail()
                 ]);

                if($emaildata==null){
                $em = $this->getDoctrine()->getManager();
                $user->setRoles("ROLE_USER");
                $em->persist($user);
                $em->flush();
                $this->addFlash('success','Üye kaydınız başarıyla gerçekleşmiştir.');

                return $this->redirectToRoute('app_login');
                }

                else
                {
                    $this->addFlash('error', $user->getEmail()." " . 'Bu e-mail adresi kayıtlıdır!');

                }
           }



        }



        return $this->render('home/newuser.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}