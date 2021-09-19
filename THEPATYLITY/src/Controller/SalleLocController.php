<?php

namespace App\Controller;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Form\SalleType;
use App\Form\ImagesType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\SalleLOc;
use App\Entity\Images;
use App\Repository\ImagesRepository ;
use App\Repository\SalleLOcRepository;
use Knp\Component\Pager\PaginatorInterface;
class SalleLocController extends AbstractController
{
    /**
     * @Route("/salle_loc-add", name="salle_loc.add")
     */

     public function index(Request $request, ObjectManager $manager)
    {

        $user = $this ->getUser();

        $salleLoc = new SalleLOc();
       $salleLoc ->setUser($user);
        $form = $this->createForm(SalleType::class, $salleLoc);
       /* $user= $this->get('security.context')->getToken()->getUser();*/
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('imageFile')->getData();

            $imageName = md5(uniqid()).'.'.$image->guessExtension();

            $salleLoc->setImage($imageName);

            $image->move(
                $this->getParameter('image_directory'), $imageName);
            $salleLoc->setImage($imageName);

            dump($image);



            // On récupère les images transmises
            $images = $form->get('images')->getData();

            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('image_directory'),
                    $fichier
                );

                // On stocke l'image dans la base de données (son nom)
                $img = new Images();
                $img->setName($fichier);
                $salleLoc->addImage($img);
            }




            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist( $salleLoc);
            $entityManager->flush();
            $this->addFlash('success', "bien enregistré !");
            return $this->redirectToRoute('author.index',['id' => $user->getUser()]);
        }





        return $this->render('salle_loc/add.html.twig', [
            'SalleType' => $form->createView(),

        ]);
    }

    /**
     * @Route("/salle_loc-image-{id}", name="salle_loc.image")
     */

    public function image( $id,Request $request, ObjectManager $manager,SalleLOcRepository  $repository)
    {

      /*   $id1=$id; */
      /*   dump($id1); */

      $id = $repository->findOneBy(['id' => $id]);

        $image = new Images();
       $image ->setSalle($id);
        $form = $this->createForm(ImageSalleType::class, $image);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('imageFile')->getData();

            $imageName = md5(uniqid()).'.'.$image->guessExtension();

            $image->setImage($imageName);

            $image->move(
                $this->getParameter('image_directory'), $imageName);
            $image->setImage($imageName);

            dump($image);



            // On récupère les images transmises
            $images = $form->get('images')->getData();

            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('image_directory'),
                    $fichier
                );

                // On stocke l'image dans la base de données (son nom)
                $img = new Images();
                $img->setName($fichier);
                $image->addImage($img);
            }




            $manager->persist($image);
            $manager->flush();
            $this->addFlash(
                'notice',
                'Images inserted successfully'
            );
            $this->addFlash('success', "bien enregistré !");
            return $this->redirectToRoute('salle_loc.salleUpdate',['id' => $id->getId()]);
        }





        return $this->render('salle_loc/image.html.twig', [
            'ImageSalleType' => $form->createView(),

        ]);
    }
    /**
     * @Route("/salle_loc-All", name="salle_loc.All")
     */

    public function allSalle( SalleLOcRepository $repository,
                          Request $request, PaginatorInterface $paginator)
    {



        $allLocation = $repository->findAll();

        $locations = $paginator->paginate(
        // Doctrine Query, not results
            $allLocation,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            12
        );



        return $this->render('salle_loc/All.html.twig', [
            'location' => $locations,
             /*'evenementFormSearchType' => $form->createView()*/
        ]);
    }


    /**
     * @Route("/salle_loc-single-{id}", name="salle_loc.single")
     */


    public function new($id, Request $request ,\Swift_Mailer $mailer,SalleLOcRepository $salleLOcRepository,
                        SalleLOc $salle,ImagesRepository $repo): Response
    {

        $user = $this ->getUser();
        /*$salle =$this->getSalleName($id);*/
        $location = $salleLOcRepository->findOneBy(['id' => $id]);
        $booking = new Booking();
        dump($id);
//        $x =$booking->getSalle($);
        $booking->setUser($user);

        $booking->setSalle( $location  );
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();




            if ($request->isMethod('POST'))


                $email = $user->getEmail();

            if ($email === null) {
                $this->addFlash('danger', 'Vous devez etre connecter pour prendre un rdv!! ');
                return $this->redirectToRoute('app_login');
            }



            try {
                $entityManager->persist($booking);
                $entityManager->flush();


            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('home');
            }



            $message = (new \Swift_Message('Comfirmation reservation'))
                ->setFrom(array('jeandesir84@gmail.com'=> 'Reservation'))
                ->setTo($user->getEmail())
                /*->setT0($location ->getUser())*/



                ->setBody(
                    $this->renderView(
                        'emails/confirmeReservation.html.twig',
                        [
                            'user'=>$user,
                            'Salle Name'=>$location ,
                            'booking' => $booking,

                        ]
                    ),
                    'text/html'
                );
            $mailer->send($message);

            $this->addFlash('success', 'Votre rdv à été pris en comte, un email de comfirmation vous à été  envoyer!');

            return $this->redirectToRoute('home');
        }



        $images =$repo->findByExampleField($id);



        return $this->render('salle_loc/single.html.twig', [
            'location' => $location,
            'Image' => $images,
          /*  'booking' => $booking,
            'form' => $form->createView(),*/

        ]);

    }

    /**
     * @Route("/salle_loc-salleUpdate-{id}", name="salle_loc.salleUpdate")
     */

     public function update($id, SalleLOcRepository $repository,Request $request, ObjectManager $manager)
    {
        $locations = $repository->findOneBy(['id' => $id]);
        $user = $this ->getUser();
        $locations ->setUser($user);
        $form = $this->createForm(SalleType::class, $locations);
        $form->handleRequest($request);
        /* if ($form->isSubmitted() && $form->isValid()) {
             $image = $form->get('')->getData();
                $imageName = $image->getImage();
             $imageName = md5(uniqid()).'.'.$image->guessExtension();
            $locations->setImage($imageName);
            $image->move(
                $this->getParameter('image_directory'), $imageName);
            $locations->setImage($imageName);
            dump($image);
            $manager->persist($locations);
            $manager->flush();
            return $this->redirectToRoute("author.index");
        } */
        return $this->render('salle_loc/salleUpdate.html.twig', [
            'location'=> $locations,
            'SalleType' => $form->createView()
        ]);
    }



}


