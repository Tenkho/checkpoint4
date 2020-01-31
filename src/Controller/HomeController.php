<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\PerformsRepository;
use App\Repository\RepresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(PerformsRepository $performsRepository) :Response
    {
        $performs = $performsRepository->findAll();
        return $this->render('home.html.twig', [
            'performs' => $performs,
        ]);
    }

    /**
     * @Route("/admin", name="admin_index")
     */
    public function indexAdmin() :Response
    {
        return $this->render('admin/home.html.twig');
    }

    /**
     * @Route("/prochain_show", name="next_show")
     */
    public function nextShow(RepresentationRepository $representationRepository, Request $request) :Response
    {
        $representation = $representationRepository->findTheNext();
        $reserved = 0;
        foreach ($representation[0]->getReservations() as $reserve) {
            $reserved += $reserve->getNbPlace();
        }
        $remaining = $representation[0]->getMaxPlace() - $reserved;
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();
            $this->addFlash('success', 'Your reservation is succesfull');

            return $this->redirectToRoute('next_show');
        }
        return $this->render('next_show.html.twig', [
            'representation' => $representation,
            'form' => $form->createView(),
            'remaining' => $remaining ?? '',
        ]);
    }
}