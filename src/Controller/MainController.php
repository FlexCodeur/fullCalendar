<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CalendrierRepository $calendrierRepository): Response
    {
        $calendars = $calendrierRepository->findAll();

        $events = [];
        foreach ($calendars as $calendar) {
            $events[] = [
                'title' => $calendar->getEntreprise(),
                'start' => $calendar->getStartAt()->format('Y-m-d H:i:s'),
                'end' => $calendar->getEndAt()->format('Y-m-d H:i:s'),
                'description' => $calendar->getLot()->getNom()
            ] ;
        }
        $datas = json_encode($events);

        return $this->render('main/index.html.twig', [
            'datas' => $datas
        ]);
    }
}
