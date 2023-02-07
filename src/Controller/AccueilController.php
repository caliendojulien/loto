<?php

namespace App\Controller;

use App\Repository\GrilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil_index')]
    public function index(
        GrilleRepository $grilleRepository
    ): Response
    {
        $grilleAttenteResultatUser = 0;
        if ($this->getUser()) {
            $grilleAttenteResultatUser = $grilleRepository->findBy(['traitee' => false, "user" => $this->getUser()]);
        }
        $montant = 0;
        $grillesProchainTirage = $grilleRepository->findBy(['traitee' => false]);
        return $this->render('accueil/index.html.twig', compact('grilleAttenteResultatUser', 'grillesProchainTirage'));
    }
}
