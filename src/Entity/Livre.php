<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"book:read"}},
 *     denormalizationContext={"groups"={"book:write"}},
 *     attributes={"order"={"titre": "DESC"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "prix": "exact", "note": "exact", "description": "partial", "categories": "exact"})
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"book:read", "book:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @Groups({"book:read", "book:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $synopsis;

    /**
     * @Groups({"book:read", "book:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @Groups({"book:read", "book:write"})
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @Groups({"book:read", "book:write"})
     * @ORM\Column(type="integer")
     */
    private $note;


    /**
     * @Groups({"book:read"})
     * @ORM\ManyToOne(targetEntity=Auteur::class, inversedBy="livres")
     */
    private $auteur;

    /**
     * @Groups({"book:read", "book:write"})
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="livre")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }



    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setLivre($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getLivre() === $this) {
                $category->setLivre(null);
            }
        }

        return $this;
    }
}
