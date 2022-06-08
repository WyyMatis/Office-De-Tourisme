<?php

namespace App\Controller;

use App\Entity\Langue;
use App\Entity\Conseillers;
use App\Repository\CreneauRepository;
use App\Repository\RDVRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ConseillerType;
use App\Repository\ConseillersRepository;
use App\Repository\LangueRepository;
use App\Repository\ResponsableConsRepository;
use App\Repository\SpecialiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboardRespCons', name: 'dashboard_resp_cons')]
    public function dashboardRespCons(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/respConsProfil', name: 'respConsProfil')]
    public function respConsProfile(ResponsableConsRepository $responsableConsRepository): Response
    {
        return $this->render('dashboard/respConsProfil.html.twig', [
            'responsableCons' => $responsableConsRepository->findAll(),
        ]);
    }

    #[Route('/dashboardRespCons/listeConseillers', name: 'dashboard_listeConseillers')]
    public function listeConseillers(ConseillersRepository $conseillersRepository, LangueRepository $langueRepository, SpecialiteRepository $specialiteRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $conseiller = new Conseillers();

        $form = $this->createForm(ConseillerType::class, $conseiller);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($conseiller);

            $entityManager->flush();

           session_unset();
        }

        return $this->render('dashboard/listeConseillers.html.twig', [
            'conseillers' => $conseillersRepository->findAllOrderByAlpha(),
            'form' => $form->createView(),
            'langues' => $langueRepository->findAll(),
            'specialite' =>  $specialiteRepository->findAll(),
        ]);
    }

    #[Route('/listeConseillers/filtrerConseillerParLangue/{langage?}', name: 'filtrerConseillerParLangue')]
    public function filtrerConseillerParLangue(string $langage, LangueRepository $langueRepository, SpecialiteRepository $specialiteRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $conseiller = new Conseillers();

        $form = $this->createForm(ConseillerType::class, $conseiller);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($conseiller);

            $entityManager->flush();

            session_unset();
        }

        $laLangue = $langueRepository->findOneBy(['langage' => $langage]);

        return $this->render('dashboard/listeConseillers.html.twig', [
            'conseillers' => $laLangue->getConseillers(),
            'langues' => $langueRepository->findAll(),
            'specialite' =>  $specialiteRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/listeConseillers/filtrerConseillerParSpecialite/{domaine?}', name: 'filtrerConseillerParSpecialite')]
    public function filtrerConseillerParSpecialite(string $domaine, LangueRepository $langueRepository, SpecialiteRepository $specialiteRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $conseiller = new Conseillers();

        $form = $this->createForm(ConseillerType::class, $conseiller);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($conseiller);

            $entityManager->flush();

            session_unset();
        }

        $leDomaine = $specialiteRepository->findOneBy(['domaine' => $domaine]);

        return $this->render('dashboard/listeConseillers.html.twig', [
            'conseillers' => $leDomaine->getConseillers(),
            'langues' => $langueRepository->findAll(),
            'specialite' =>  $specialiteRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteConseiller/{id?}', name: 'deleteConseillers')]
    public function deleteConseiller(ConseillersRepository $conseillersRepository,int $id, EntityManagerInterface $entityManager): RedirectResponse
    {

        $conseillerToRemove = $conseillersRepository->find($id);

        $entityManager->remove($conseillerToRemove);
        $entityManager->flush();

        return $this->redirectToRoute('dashboard_listeConseillers', []);
    }

    #[Route('/dashboardRespCons/planningGlobal', name: 'dashboard_planningGlobal')]
    public function planningGlobal(CreneauRepository $creneauRepository, RDVRepository $RDVRepository): Response
    {
        $events = $creneauRepository->findAll();

        $eventsRDV = $RDVRepository->findAll();

        $AllCreneaux = [];

        $AllRDV = [];

        foreach ($events as $event)
        {
            $AllCreneaux[] = [
                'id' => $event->getId(),
                'start' => $event->getHeureDebut()->format('Y-m-d H:i:s'),
                'end' => $event->getHeureFin()->format('Y-m-d H:i:s'),
                'title' => $event->getTitre(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor()
            ];
        }

        foreach ($eventsRDV as $event)
        {
            $AllRDV[] = [
                'id' => $event->getId(),
                'start' => $event->getHeureDebut()->format('Y-m-d H:i:s'),
                'end' => $event->getHeureFin()->format('Y-m-d H:i:s'),
                'title' => $event->getTitre(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor()
            ];
        }

        $dataAllCreneaux = json_encode($AllCreneaux);
        $dataAllRDV = json_encode($AllRDV);

        return $this->render('dashboard/planningGlobal.html.twig', [
            'dataAllCreneaux' => $dataAllCreneaux,
            'dataAllRDV' => $dataAllRDV
        ]);
    }

    #[Route('/dashboardRespCons/stats', name: 'dashboard_stats')]
    public function stats(): Response
    {
        return $this->render('dashboard/stats.html.twig', [
        ]);
    }

    #[Route('/dashboardRespCons/listeConseillers/conseillers/{id?}', name: 'conseillers')]
    public function conseillers(?int $id, ConseillersRepository $conseillersRepository): Response
    {
        $conseillers = $conseillersRepository->find($id);

        $events = $conseillers->getCreneaus();

        $creneaux = [];

        foreach ($events as $event)
        {
            $creneaux[] = [
                'id' => $event->getId(),
                'start' => $event->getHeureDebut()->format('Y-m-d H:i:s'),
                'end' => $event->getHeureFin()->format('Y-m-d H:i:s'),
                'title' => $event->getTitre(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor()
            ];
        }

        $dataCreneaux = json_encode($creneaux);

        return $this->render('dashboard/conseillers.html.twig',[
            'controller_name' => 'DashboardController',
            'id' => $id,
            'conseillers' => $conseillers,
            'dataCreneaux' => $dataCreneaux
        ]);
    }
}
