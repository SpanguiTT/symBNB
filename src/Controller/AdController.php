<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     *
     * @param AdRepository $adRepo
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AdRepository $adRepo)
    {
        $ads = $adRepo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     *
     * @Route("/ads/{slug}", name="ads_show_OLD")
     *
     * @param $slug
     * @param AdRepository $adRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showOLD($slug, AdRepository $adRepository)
    {
        // Je récupère l'annonce qui correspond au slug
        //$ad = $adRepository->findOneBySlug($slug);
        $ad = $adRepository->findOneBy(array('slug' => $slug));

        return $this->render('ad/show.html.twig', [
            'ad' => $ad
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     *
     * @Route("/ads/{slug}", name="ads_show")
     *
     * @param Ad $ad
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Ad $ad)
    {
        return $this->render('ad/show.html.twig', [
            'ad' => $ad
        ]);
    }
}
