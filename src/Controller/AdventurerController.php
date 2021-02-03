<?php


namespace App\Controller;


use App\Repository\AssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdventurerController extends AbstractController
{
    /**
     * @Route("adventurer/", name="adventurer_index")
     */
    public function index(AssetRepository $assetRepository): Response
    {
        $adventurer = $this->getUser();
        $adventurerAssets = $assetRepository->findBy(['owner' => $adventurer], ['depositDate' => 'DESC']);
        return $this->render('adventurer/index.html.twig', [
            'assets' => $adventurerAssets
        ]);
    }
}
