<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\User;
use App\Entity\SalleLOc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\EvenementRepository;
use App\Repository\SalleLOcRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
/**
 * @Route("/api", name="api_")
 */
class APIController0 extends AbstractController
{


    /**
     * @Route("/evenement/lire/{id}", name="evenement", methods={"GET"})
     */
    public function getArticle(SalleLOc $salle)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($salle, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/evenement/ajout", name="ajout", methods={"POST"})
     */
    public function addEvenement(Request $request)
    {
        // On vérifie si la requête est une requête Ajax
       // if ($request->isXmlHttpRequest()) {
            // On instancie un nouvel article
            $evnements= new Evenement();

            // On décode les données envoyées
            $donnees = json_decode($request->getContent());

            // On hydrate l'objet
            $evnements->setName($donnees->name);
           /*  $evnements->setDate($donnees->date); */
            $evnements->setAddress($donnees->address);
            $evnements->setContry($donnees->contry);
            $evnements->setCity($donnees->city);
            $evnements->setLat($donnees->Lat);
            $evnements->setLng($donnees->lng);
            $evnements->setImage($donnees->image);
            /* $client = $this->getUser(); */
            /*  $id =  $this->$client->getId(); */

            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(["id" => 3]);
            $evnements->setUser($user);

            // On sauvegarde en base
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evnements);
            $entityManager->flush();

            // On retourne la confirmation
            return new Response('ok', 201);
       /*  }
        return new Response('Failed', 404); */
  /*   } */
    }
    /**
     * @Route("/evnement/editer/{id}", name="edit", methods={"PUT"})
     */
    public function editEvenement(?Evenement $evnements, Request $request)
    {
        // On vérifie si la requête est une requête Ajax
        if ($request->isXmlHttpRequest()) {

            // On décode les données envoyées
            $donnees = json_decode($request->getContent());

            // On initialise le code de réponse
            $code = 200;

            // Si l'article n'est pas trouvé
            if (!$evnements) {
                // On instancie un nouvel article
                $evnements = new Evenement();
                // On change le code de réponse
                $code = 201;
            }

            // On hydrate l'objet
            $evnements->setName($donnees->name);
            /* $evnements->setDate($donnees->date); */
            $evnements->setAddress($donnees->address);
            $evnements->setContry($donnees->contry);
            $evnements->setCity($donnees->city);
            $evnements->setLat($donnees->Lat);
            $evnements->setLng($donnees->lng);
            $evnements->setImage($donnees->image);
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(["id" => 1]);
            $evnements->setUser($user);
            // On sauvegarde en base
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evnements);
            $entityManager->flush();

            // On retourne la confirmation
            return new Response('ok', $code);
        }
        return new Response('Failed', 404);
    }


    /**
     * @Route("/evenement/supprimer/{id}", name="supprime", methods={"DELETE"})
     */
    public function removeEvent(Evenement $evnements)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($evnements);
        $entityManager->flush();
        return new Response('ok');
    }

    /**
     * @Route("/sales/liste", name="liste", methods={"GET"})
     */
    public function liste(SalleLOcRepository $salleLOcRepository)
    {
        // On récupère la liste des articles
        $salle = $salleLOcRepository->apiFindSall();

        // On spécifie qu'on utilise l'encodeur JSON
        $encoders = [new JsonEncoder()];

        // On instancie le "normaliseur" pour convertir la collection en tableau
        $normalizers = [new ObjectNormalizer()];

        // On instancie le convertisseur
        $serializer = new Serializer($normalizers, $encoders);

        // On convertit en json
        $jsonContent = $serializer->serialize($salle, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        // On instancie la réponse
        $response = new Response($jsonContent);

        // On ajoute l'entête HTTP
        $response->headers->set('Content-Type', 'application/json');

        // On envoie la réponse
        return $response;
    }
}
