<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Evenement;
use App\Entity\SalleLOc;
use App\Form\EvenementType;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Repository\BookingRepository;
use App\Repository\SalleLOcRepository;
use App\Repository\EvenementRepository;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Registration;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author-index", name="author.index")
     */
    public function index()
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    /**
     * @Route("/author-edit", name="author.edit")
     */
    public function edit()
    {
        return $this->render('author/edit.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    /**
     * @Route("/author-allAuthors", name="author.allAuthors")
     */
    /*public function allAuthor()
    {
        return $this->render('author/allAuthors.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }*/

    public function user(/*$id*/UserRepository $query,EvenementRepository $evenementRepository,
                                Request $request, PaginatorInterface $paginator)
    {



        /*   $user = $query->findOneBy(['id' => $id]);*/

        $allusers = $query->findAll();

        foreach ($allusers as $key => $value){
            $value->getId();
            dump($value);
            $evenement =$evenementRepository->findByEvent($value);
            dump($evenement);
        }

        /*for($i = 0; $i< $allusers; $i++){
            $user= $allusers[$i]->getId();

            $evenement =$evenementRepository->findByEvent($user);

        }*/


        $users = $paginator->paginate(
        // Doctrine Query, not results
            $allusers,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            8
        );



        return $this->render('author/allAuthors.html.twig', [
            'users' => $users,
            'evenement'=>$evenement


        ]);
    }
    /**
     * @Route("/author-profil-{id}", name="author.profil")
     */

    public function findByuserevent($id,UserRepository  $query, EvenementRepository $repository,
                                    objectManager $manager,Request $request, PaginatorInterface $paginator)
    {


        $users = $query->findOneBy(['id' => $id]);
        $usersid =$users ;

        $allEvenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findByuserevent($usersid);


        $evenements = $paginator->paginate(
        // Doctrine Query, not results
            $allEvenements,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            9
        );




        return $this->render('author/profil.html.twig', [
            'evenement' => $evenements,
            'user' => $users
        ]);
    }
    /**
     * @Route("/author-index", name="author.index")
     */

    public function allEvent(UserRepository  $query,BookingRepository $book, EvenementRepository $repository,SalleLOcRepository $repo,
                                     objectManager $manager,Request $request, PaginatorInterface $paginator)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $usersid = $user ;

        $allEvenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findByuserevent($usersid);


        $local = $this->getDoctrine()
            ->getRepository(SalleLOc::class)
            ->findByuserLocal($usersid);

        $evenements = $paginator->paginate(
        // Doctrine Query, not results
            $allEvenements,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            9
        );

        $location = $paginator->paginate(
        // Doctrine Query, not results
            $local,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            9
        );





        return $this->render('author/index.html.twig', [
            'evenement' => $evenements,
            'location' => $location,

        ]);
    }

public function local(/*$id,*/UserRepository  $query, SalleLOcRepository $repository,
                                     objectManager $manager,Request $request, PaginatorInterface $paginator)
    {
/*
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $usersid = $user ;

        $local = $this->getDoctrine()
            ->getRepository(SalleLOc::class)
            ->findByuserLocal($usersid);


        $location = $paginator->paginate(
        // Doctrine Query, not results
            $local,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            9
        );


        return $this->render('author/index.html.twig', [
            'location' => $location,

        ]); */
    }





    /**
     * @Route("/author-{id}-edit", name="author.edit")
     */
    public function authoedit($id, UserRepository $repository,Request $request, ObjectManager $manager,
                              UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler,
                              LoginFormAuthenticator $authenticator)
    {




        $user = $repository->findOneBy(['id' => $id]);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $image = $form->get('image')->getData();

            $imageName = md5(uniqid()).'.'.$image->guessExtension();

            $user->setImage($imageName);

            $image->move(
                $this->getParameter('image_directory'), $imageName);
            $user->setImage($imageName);

            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute("home");

        }

        return $this->render('author/edit.html.twig', [
            'formUserType' => $form->createView()
        ]);

    }

    /**
     * @Route("/author-{id}-ressetpassword", name="author.ressetpassword")
     */

public function editAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
    	$form = $this->createForm(ResetPasswordType::class, $user);

    	$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $passwordEncoder = $this->get('security.password_encoder');
            $oldPassword = $request->request->get('etiquettebundle_user')['oldPassword'];

            // Si l'ancien mot de passe est bon
            if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
                $newEncodedPassword = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($newEncodedPassword);

                $em->persist($user);
                $em->flush();

                $this->addFlash('notice', 'Votre mot de passe à bien été changé !');

                return $this->redirectToRoute('profile');
            } else {
                $form->addError(new FormError('Ancien mot de passe incorrect'));
            }
        }

    	return $this->render('author/ressetpassword.html.twig', array(
    		'form' => $form->createView(),
    	));
    }








}
