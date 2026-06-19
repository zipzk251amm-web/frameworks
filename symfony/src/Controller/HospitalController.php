<?php

namespace App\Controller;

use App\Entity\Hospital;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HospitalController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/hospitals', name: 'get_hospitals', methods: ['GET'])]
    public function getHospitals(): JsonResponse
    {
        $hospitals = $this->entityManager->getRepository(Hospital::class)->findAll();
        return $this->json(['data' => $hospitals], Response::HTTP_OK);
    }

    #[Route('/hospitals/{id}', name: 'get_hospital_item', methods: ['GET'])]
    public function getHospitalItem(int $id): JsonResponse
    {
        $hospital = $this->entityManager->getRepository(Hospital::class)->find($id);
        if (!$hospital) {
            return $this->json(['error' => 'Hospital not found'], Response::HTTP_NOT_FOUND);
        }
        return $this->json(['data' => $hospital], Response::HTTP_OK);
    }

    #[Route('/hospitals', name: 'create_hospital', methods: ['POST'])]
    public function createHospital(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $hospital = new Hospital();
        $hospital->setName($data['name']);
        $hospital->setAddress($data['address']);
        $hospital->setPhone($data['phone']);
        $hospital->setBeds($data['beds']);
        if (isset($data['rating'])) {
            $hospital->setRating($data['rating']);
        }

        $this->entityManager->persist($hospital);
        $this->entityManager->flush();

        return $this->json(['data' => $hospital], Response::HTTP_CREATED);
    }

    #[Route('/hospitals/{id}', name: 'patch_hospital', methods: ['PATCH'])]
    public function patchHospital(Request $request, int $id): JsonResponse
    {
        $hospital = $this->entityManager->getRepository(Hospital::class)->find($id);
        if (!$hospital) {
            return $this->json(['error' => 'Hospital not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) $hospital->setName($data['name']);
        if (isset($data['address'])) $hospital->setAddress($data['address']);
        if (isset($data['phone'])) $hospital->setPhone($data['phone']);
        if (isset($data['beds'])) $hospital->setBeds($data['beds']);
        if (isset($data['rating'])) $hospital->setRating($data['rating']);

        $this->entityManager->flush();
        return $this->json(['data' => $hospital], Response::HTTP_OK);
    }

    #[Route('/hospitals/{id}', name: 'delete_hospital', methods: ['DELETE'])]
    public function deleteHospital(int $id): JsonResponse
    {
        $hospital = $this->entityManager->getRepository(Hospital::class)->find($id);
        if (!$hospital) {
            return $this->json(['error' => 'Hospital not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($hospital);
        $this->entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}