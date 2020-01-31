<?php

namespace App\Controller;

use App\Entity\Performs;
use App\Form\PerformsType;
use App\Repository\PerformsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/performs")
 */
class PerformsController extends AbstractController
{
    /**
     * @Route("/", name="performs_index", methods={"GET"})
     */
    public function index(PerformsRepository $performsRepository): Response
    {
        return $this->render('admin/performs/index.html.twig', [
            'performs' => $performsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="performs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $perform = new Performs();
        $form = $this->createForm(PerformsType::class, $perform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($perform);
            $entityManager->flush();

            return $this->redirectToRoute('performs_index');
        }

        return $this->render('admin/performs/new.html.twig', [
            'perform' => $perform,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performs_show", methods={"GET"})
     */
    public function show(Performs $perform): Response
    {
        return $this->render('admin/performs/representation.html.twig', [
            'perform' => $perform,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="performs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Performs $perform): Response
    {
        $form = $this->createForm(PerformsType::class, $perform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('performs_index');
        }

        return $this->render('admin/performs/edit.html.twig', [
            'perform' => $perform,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performs_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Performs $perform): Response
    {
        if ($this->isCsrfTokenValid('delete'.$perform->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($perform);
            $entityManager->flush();
        }

        return $this->redirectToRoute('performs_index');
    }
}
