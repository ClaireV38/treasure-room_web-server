<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\AssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(AssetRepository $assetRepository): Response
    {
        $lastAssets = $assetRepository->findBy([], ['depositDate' => 'DESC'],3);
        return $this->render('home/index.html.twig', [
            'assets' => $lastAssets
        ]);
    }
}
