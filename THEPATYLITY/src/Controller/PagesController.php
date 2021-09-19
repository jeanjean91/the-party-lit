<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("/pages.faq", name="pages.faq")
     */
    public function faq()
    {
        return $this->render('pages/faq.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }
    /**
     * @Route("/pages.about-us", name="pages.about-us")
     */
    public function About()
    {
        return $this->render('pages/about-us.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }
    /**
     * @Route("/pages.contact", name="pages.contact")
     */
    public function contact()
    {
        return $this->render('pages/contact.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }
    /**
     * @Route("/pages.work", name="pages.work")
     */
    public function work()
    {
        return $this->render('pages/work.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }


    /**
     * @Route("/pages-siteMap", name="pages.siteMap")
     */
    public function siteMap()
    {
        return $this->render('pages/siteMap.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

}
