<?php

namespace App\Controller;

use App\Entity\Grille;
use App\Entity\Tirage;
use App\Form\GrilleType;
use App\Form\TirageType;
use App\Repository\GrilleRepository;
use App\Repository\TirageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuController extends AbstractController
{
    #[Route('/jouer', name: 'jeu_index')]
    public function index(
        Request                $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $grille = new Grille();
        $grilleForm = $this->createForm(GrilleType::class, $grille);
        $grilleForm->handleRequest($request);
        $grille = $this->setJeu($grille);
        if ($grilleForm->isSubmitted() && $grilleForm->isValid()) {
            $entityManager->persist($grille);
            $entityManager->flush();
            return $this->redirectToRoute('accueil_index');
        }
        return $this->render('jeu/index.html.twig', compact('grilleForm'));
    }

    #[Route('/tirage', name: 'jeu_tirage')]
    public function tirage(
        Request                $request,
        EntityManagerInterface $entityManager,
        GrilleRepository       $grilleRepository
    ): Response
    {
        $grillesEnAttentes = $grilleRepository->findBy(['traitee' => false]);
        $tirage = new Tirage();
        $tirage->setMontant(count($grillesEnAttentes) * 2.2);
        $tirageForm = $this->createForm(TirageType::class, $tirage);
        $tirageForm->handleRequest($request);
        $tirage = $this->setTirage($tirage);
        if ($tirageForm->isSubmitted() && $tirageForm->isValid()) {
            $entityManager->persist($tirage);
            $entityManager->flush();
            $grilles = $grilleRepository->findBy(['traitee' => false]);
            foreach ($grilles as $grille) {
                $nbBonNumero = 0;
                $numeroChance = false;
                if (
                    $grille->getNumero1() == $tirage->getNumero1()
                    || $grille->getNumero1() == $tirage->getNumero2()
                    || $grille->getNumero1() == $tirage->getNumero3()
                    || $grille->getNumero1() == $tirage->getNumero4()
                    || $grille->getNumero1() == $tirage->getNumero5()
                ) {
                    $nbBonNumero++;
                }
                if (
                    $grille->getNumero2() == $tirage->getNumero1()
                    || $grille->getNumero2() == $tirage->getNumero2()
                    || $grille->getNumero2() == $tirage->getNumero3()
                    || $grille->getNumero2() == $tirage->getNumero4()
                    || $grille->getNumero2() == $tirage->getNumero5()
                ) {
                    $nbBonNumero++;
                }
                if (
                    $grille->getNumero3() == $tirage->getNumero1()
                    || $grille->getNumero3() == $tirage->getNumero2()
                    || $grille->getNumero3() == $tirage->getNumero3()
                    || $grille->getNumero3() == $tirage->getNumero4()
                    || $grille->getNumero3() == $tirage->getNumero5()
                ) {
                    $nbBonNumero++;
                }
                if (
                    $grille->getNumero4() == $tirage->getNumero1()
                    || $grille->getNumero4() == $tirage->getNumero2()
                    || $grille->getNumero4() == $tirage->getNumero3()
                    || $grille->getNumero4() == $tirage->getNumero4()
                    || $grille->getNumero4() == $tirage->getNumero5()
                ) {
                    $nbBonNumero++;
                }
                if (
                    $grille->getNumero5() == $tirage->getNumero1()
                    || $grille->getNumero5() == $tirage->getNumero2()
                    || $grille->getNumero5() == $tirage->getNumero3()
                    || $grille->getNumero5() == $tirage->getNumero4()
                    || $grille->getNumero5() == $tirage->getNumero5()
                ) {
                    $nbBonNumero++;
                }
                if (
                    $grille->getNumerochance() == $tirage->getNumerochance()
                ) {
                    $numeroChance = true;
                }
                $grille->setNbBonNumero($nbBonNumero);
                $grille->setTraitee(true);
                $grille->setBonNumerChance($numeroChance);
                $entityManager->persist($grille);
                $entityManager->flush();
            }
            return $this->redirectToRoute('accueil_index');
        }
        return $this->render('jeu/tirage.html.twig', compact('tirageForm'));
    }

    #[Route('/recherche-gagnant', name: 'jeu_recherche_gagnant')]
    public function recherche_gagnant(
        Request                $request,
        EntityManagerInterface $entityManager,
        TirageRepository       $tirageRepository
    ): Response
    {
        $tirages = $tirageRepository->findAll();
        return $this->render('jeu/recherche_gagnant.html.twig', compact('tirages'));
    }

    private function setJeu(Grille $grille): Grille
    {
        $grille->setDate(new \DateTime());
        $grille->setUser($this->getUser());
        $grille->setTraitee(false);
        $grille->setGain(null);
        $grille->setNbBonNumero(null);
        $grille->setBonNumerChance(null);
        return $grille;
    }

    private function setTirage(Tirage $tirage): Tirage
    {
        $boules = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
            11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
            21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
            31, 32, 33, 34, 35, 36, 37, 38, 39, 40,
            41, 42, 43, 44, 45, 46);
        $chance = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        $hasardBoules = array_rand($boules, 5);
        $tirage->setNumero1($hasardBoules[0]);
        $tirage->setNumero2($hasardBoules[1]);
        $tirage->setNumero3($hasardBoules[2]);
        $tirage->setNumero4($hasardBoules[3]);
        $tirage->setNumero5($hasardBoules[4]);
        $hasardChance = array_rand($chance, 1);
        $tirage->setNumerochance($hasardChance);
        $tirage->setDate(new \DateTime());
        return $tirage;
    }

}
