<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModuleRepository::class)
 */
class Module
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomModule;

    /**
     * @ORM\Column(type="integer")
     */
    private $coeffModule;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="module")
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomModule(): ?string
    {
        return $this->nomModule;
    }

    public function setNomModule(string $nomModule): self
    {
        $this->nomModule = $nomModule;

        return $this;
    }

    public function getCoeffModule(): ?int
    {
        return $this->coeffModule;
    }

    public function setCoeffModule(int $coeffModule): self
    {
        $this->coeffModule = $coeffModule;

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setModule($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getModule() === $this) {
                $note->setModule(null);
            }
        }

        return $this;
    }
}
