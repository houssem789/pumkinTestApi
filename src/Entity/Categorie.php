<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"cat:read"}},
 *     denormalizationContext={"groups"={"cat:write"}}
 * )
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"cat:read", "cat:write"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"cat:read", "cat:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @Groups({"cat:read", "cat:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $tag;

    /**
     * @Groups({"cat:read", "cat:write"})
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="categories")
     */
    private $livre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): self
    {
        $this->livre = $livre;

        return $this;
    }
}
