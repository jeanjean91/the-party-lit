<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\SalleLOc;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Repository\SalleLOcRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/booking")
 */
class BookingController extends AbstractController
{
    /**
     * @Route("/", name="booking_index", methods={"GET"})
     */
    public function index(BookingRepository $bookingRepository): Response
    {
        return $this->render('booking/index.html.twig', [
            'bookings' => $bookingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="booking_new",  methods={"GET","POST"})
     */
    public function new($id,Request $request ,\Swift_Mailer $mailer,SalleLOcRepository $salleLOcRepository): Response
    {


        $user = $this ->getUser();

        $location = $salleLOcRepository->findOneBy(['id' => $id]);
        $booking = new Booking();
        dump($location );
//
        $booking->setUser($user);

        $booking->setSalle( $location);
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

            $this->addFlash('success', 'Votre reservation à été pris en comte, un email de comfirmation vous à été  envoyer!');

            return $this->redirectToRoute('home');
        }


        return $this->render('booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/calendar", name="booking_calendar", methods={"GET"})
     */
    public function calendar(): Response
    {
        return $this->render('booking/calendar.html.twig');
    }

    /**
     * @Route("/{id}", name="booking_show", methods={"GET"})
     */
    public function show($id,Booking $booking,Request $request, PaginatorInterface $paginator): Response
    {
        $local = $this->getDoctrine()
            ->getRepository(SalleLOc::class)
            ->findBysalle($id);

        $location = $paginator->paginate(
        // Doctrine Query, not results
            $local,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            9
        );
        return $this->render('booking/show.html.twig', [
            'booking' => $booking,
            'location' => $location,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="booking_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Booking $booking): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('booking_index');
        }

        return $this->render('booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="booking_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Booking $booking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($booking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('booking_index');
    }
}
