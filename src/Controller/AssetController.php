<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Form\AssetType;
use App\Repository\AssetRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/asset", name="asset_")
 */
class AssetController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @param Request $request
     * @param AssetRepository $assetRepository
     * @param CategoryRepository $categoryRepository
     * @param UserRepository $userRepository
     * @param DateTimeNormalizer $timeNormalizer
     * @return Response
     */
    public function index(
        Request $request,
        AssetRepository $assetRepository,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository): Response
    {
        $assets = $assetRepository->findall();
        return $this->json($assets, 200, [], [
            'groups' => 'asset:read'
        ]);
    }

    /**
     * @Route("/", name="new", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function new(Request $request, SerializerInterface $serializer,
        EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $getJson = $request->getContent();
        try {
            $asset = $serializer->deserialize($getJson, Asset::class, 'json');
            $asset->setDepositDate(new \DateTime());

            $errors = $validator->validate($asset);
            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }
            $entityManager->persist($asset);
            $entityManager->flush();
            return $this->json($asset, 201, [], [
                'groups' => 'asset:read'
            ]);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        } catch (NotNormalizableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Asset $asset): Response
    {
        return $this->json($asset, 200, [], [
            'groups' => 'asset:read'
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Asset $asset): Response
    {
        $form = $this->createForm(AssetType::class, $asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adventurer_index');
        }

        return $this->render('asset/edit.html.twig', [
            'asset' => $asset,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Asset $asset): Response
    {
        if ($this->isCsrfTokenValid('delete' . $asset->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($asset);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adventurer_index');
    }
}
