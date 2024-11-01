<?php

namespace App\Controller;

use App\Entity\Group;
use App\Repository\GroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/group')]
final class GroupController extends AbstractController
{
    #[Route('/', name: 'app_group_index', methods: ['GET'])]
    public function index(GroupRepository $groupRepository): JsonResponse
    {
        $groups = $groupRepository->findAll();
        return $this->json($groups);
    }

    #[Route('/new', name: 'app_group_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $group = new Group();
        $group->setName($data['name']);

        $entityManager->persist($group);
        $entityManager->flush();

        return $this->json($group, 201);
    }

    #[Route('/{id}', name: 'app_group_show', methods: ['GET'])]
    public function show(Group $group): JsonResponse
    {
        return $this->json($group);
    }

    #[Route('/{id}/edit', name: 'app_group_edit', methods: ['PATCH'])]
    public function edit(Request $request, Group $group, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $group->setName($data['name']);

        $entityManager->flush();

        return $this->json($group);
    }

    #[Route('/{id}', name: 'app_group_delete', methods: ['DELETE'])]
    public function delete(Request $request, Group $group, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($group);
        $entityManager->flush();

        return $this->json(null, 204);
    }
}
