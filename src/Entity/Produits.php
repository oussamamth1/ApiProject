<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitsRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 * @ApiResource(formats={"json"})
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "nomp": "exact", "description": "partial"})
 * @ApiFilter(DateFilter::class, properties={"cratedAt","updatedAt"})
 */
class Produits
{

use ResourceId;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="produits")
     */
    private $categories;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $cratedAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

  

    public function getNomp(): ?string
    {
        return $this->nomp;
    }

    public function setNomp(string $nomp): self
    {
        $this->nomp = $nomp;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getCratedAt(): ?\DateTimeInterface
    {
        return $this->cratedAt;
    }

    public function setCratedAt(\DateTimeInterface $cratedAt): self
    {
        $this->cratedAt = $cratedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    // public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    // {
    //     $this->updatedAt = $updatedAt;

    //     return $this;
    // }
}
