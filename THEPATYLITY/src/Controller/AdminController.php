<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\EvenementRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Query;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(UserRepository $repository )
    {
     /* $total ='user.id';*/
        $user =$repository->findByExampleField();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'user'=>$user
        ]);
    }
    /**
     * @Route("/admin-user", name="admin.user")
     */
    public function user( UserRepository $repository,
                          objectManager $manager,Request $request, PaginatorInterface $paginator)
    {




        $allusers = $repository->findAll();
        $users = $paginator->paginate(
        // Doctrine Query, not results
            $allusers,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            7
        );



        return $this->render('admin/user.html.twig', [
            'users' => $users,

        ]);
    }
    /**
     * @Route("/admin-evenements", name="admin.evenements")
     */
    public function produit( EvenementRepository $repository,
                           objectManager $manager,Request $request, PaginatorInterface $paginator)
    {



        $allproduits = $repository->findAll();
        $evenements = $paginator->paginate(
        // Doctrine Query, not results
            $allproduits,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            7
        );


        return $this->render('admin/evenements.html.twig', [
            'evenement' => $evenements
        ]);
    }
    /**
     * @Route("admin-calendar", name="admin_calendar") methods={"GET"})
     * @param BookingRepository $calendar
     * @return Response
     */
    public function booking(BookingRepository $calendar)
    {
        $events = $calendar->findAll();

        $rdvs = [];

        foreach($events as $event){
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getBeginAt()->format('Y-m-d H:i:s'),
                'end' => $event->getEndAt()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('admin/calendar.html.twig', compact('data'));
    }





}
