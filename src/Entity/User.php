<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var Collection<int, Group>
     */
    #[ORM\ManyToMany(targetEntity: Group::class, inversedBy: 'users')]
    private Collection $groupsOfUser;

    public function __construct()
    {
        $this->groupsOfUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getname(): ?string
    {
        return $this->name;
    }

    public function setname(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getGroupsOfUser(): Collection
    {
        return $this->groupsOfUser;
    }

    public function addGroupsOfUser(Group $groupsOfUser): static
    {
        if (!$this->groupsOfUser->contains($groupsOfUser)) {
            $this->groupsOfUser->add($groupsOfUser);
        }

        return $this;
    }

    public function removeGroupsOfUser(Group $groupsOfUser): static
    {
        $this->groupsOfUser->removeElement($groupsOfUser);

        return $this;
    }
}
