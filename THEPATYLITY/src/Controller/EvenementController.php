<?php

namespace App\Controller;

use App\Entity\EvenementSearch;
use App\Entity\MapMarker;
use App\Entity\User;
use App\Form\EvenementsearchType;
use App\Form\EvenementsFormType;
use App\Form\EvenementType;
use App\Form\MapMarkerType;
use App\Form\RechercheType;
use App\Form\SearchEvenementType;
use App\Repository\EvenementRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evenement;


class EvenementController extends AbstractController
{


    /**
     * @Route("/evenement-add", name="evenement.add")
     */


    public function new(Request $request, ObjectManager $manager)
    {

        $user = $this ->getUser();

        $evenement = new Evenement();
       $evenement ->setUser($user);
        $form = $this->createForm(EvenementType::class, $evenement);
       /* $user= $this->get('security.context')->getToken()->getUser();*/

        $form->handleRequest($request);
          dump($evenement);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            /*    $imageName = $image->getImage();*/
            $imageName = md5(uniqid()).'.'.$image->guessExtension();

            $evenement->setImage($imageName);

            $image->move(
                $this->getParameter('image_directory'), $imageName);
            $evenement->setImage($imageName);

            dump($image);



            $manager->persist($evenement);
            $manager->flush();
            $this->addFlash('success', "Evenement bien enregistré !");
            return $this->redirectToRoute('home',['id' => $user->getUser()]);//, ['id' => $produit->getId()]);
        }




        dump('bonjour');
        return $this->render('evenement/add.html.twig', [
            'formEvenementType' => $form->createView(),

        ]);
    }


    /**
     * @Route("/evenement-{id}-addMarker", name="evenement.addMarker")
     */
    public function newMrker($id,Request $request, ObjectManager $manager)
    {
       $user= $this ->getEvnementId($id);

        $mapMarker = new MapMarker();

         $mapMarker ->setEvnementId($user);
        $formula = $this->createForm(MapMarkerType::class, $mapMarker);
        /* $user= $this->get('security.context')->getToken()->getUser();*/

        $formula->handleRequest($request);
        /*  dump($evenement);*/
        if ($formula->isSubmitted() && $formula->isValid()) {
            $manager->persist($mapMarker);
            $manager->flush();
            $this->addFlash('success', "bien enregistré !");
            return $this->redirectToRoute('author/index.html.twig');
        }


        dump('bonjour');
        return $this->render('evenement/addMarker.html.twig', [

            'formMapmarker' => $formula->createView()
        ]);



    }

    /**
     * @Route("/evenement-statique-{id}", name="evenement.statique")
     */
    public function show($id, EvenementRepository $repository)
    {
        $evenemets = $repository->findOneBy(['id' => $id]);

        return $this->render('evenement/statique.html.twig', [
            'evenement' => $evenemets
        ]);
    }

    /**
     * @Route("/home-search", name="home.search")
     */


    public function index(Request $request,EvenementRepository $repository,ObjectManager $manager)
    {

       $search = new Evenement();
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($search);
            $manager->flush();
            $this->addFlash('success', "bien enregistré !");
            return $this->redirectToRoute('home');
        }
        /* dump('bonjour'); */

/* 
         var_dump(dirname('__XML__'));
            $filename = "../public/xml/point.xml";
            if (file_exists($filename)) {
                unlink($filename);
                echo 'loading.....';
            } else {
                echo "le fichier n'exite pas";
            }


            $xw = xmlwriter_open_memory('<?xml version ="1.0" encoding="utf-8" standLone= "yes" ?>');
            xmlwriter_set_indent($xw, 1);


            $xml= '<markers>';

            foreach( $allEvenements as $key =>$row) {

                $id = $row->getId();
                $Lat = $row->getLat();
                $lng = $row->getLng();
                $name =$row->getName();
                $address=$row->getAddress();
                $image =$row->getImage();
                $type =$row->getType();

                dump($row);

                $xml .="<marker id='$id' name ='$name'  address ='$address'  lat ='$Lat' lng = '$lng' type ='$type' image='$image' />";

            }


        

        $xml.= '</markers>';
        file_put_contents($filename, $xml);
 */

        return $this->render('home/search.html.twig', [
            'evenementFormSearchType' => $form->createView()
        ]);
   }
    /**
     * @Route("/author-{id}-update", name="author.update")
     */
    public function update($id, EvenementRepository $repository,Request $request, ObjectManager $manager)
    {

        $evenement = $repository->findOneBy(['id' => $id]);

        $user = $this ->getUser();



        $evenement ->setUser($user);

        $form = $this->createForm(EvenementType::class, $evenement);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            /*    $imageName = $image->getImage();*/
            $imageName = md5(uniqid()).'.'.$image->guessExtension();

            $evenement->setImage($imageName);

            $image->move(
                $this->getParameter('image_directory'), $imageName);
            $evenement->setImage($imageName);

            dump($image);

            $manager->persist($evenement);
            $manager->flush();
            return $this->redirectToRoute("home");

        }

        return $this->render('author/update.html.twig', [
            'formEvenementType' => $form->createView()
        ]);
    }



}
