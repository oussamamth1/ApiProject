<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitsRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;

use Symfony\Component\Validator\Constraints\Locale;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints\Country;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 *  @ApiResource(formats={"json"},
 * collectionOperations={
 *           "post"={"denormalizationContext"={"groups"={"write"}}},
 *          "get"={"normalization_context"={"groups"="readProducts"}},
 *     },
 * 
 *   normalizationContext={"groups"={"get"}},
 *     itemOperations={
 *         "put",
 *          "patch",
 *           "delete",
 *         "get"={
 *             "normalization_context"={"groups"={"readProducts_details"}}
 *         }
 *     })
 * @ApiFilter(SearchFilter::class, properties={"ville": "exact", "nomp": "partial", "description": "partial"})
 * @ApiFilter(DateFilter::class, properties={"cratedAt","updatedAt"})
 * @Vich\Uploadable
 * 
 */
class Produits
{

use ResourceId;
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"readProducts","readProducts_details","write"})
     * @Assert\Length(min=5, max=20)
     * 
     */
    private $nomp;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"readProducts","readProducts_details","write"})
     * @Assert\Length(min=1, max=20)
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="produits")
     *@Groups({"readProducts","readProducts_details","write"})
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
      /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"readProducts","readProducts_details","write"})
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"readProducts","readProducts_details","write"})
     */
    private $pubStatut;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"readProducts","readProducts_details","write"})
     * @Assert\Length(min=3, max=20)
      *@Assert\Choice({"mahdia", "sousse", "kairawan","tunisia","kelibia"})
     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"readProducts","readProducts_details","write"})
     * @Assert\Length(min=7, max=20)
     */
    private $numberphone;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="produits")
     *  @Groups({"readProducts","readProducts_details","write"})
     */
    private $publisher;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Groups({"readProducts","readProducts_details","write"})
     */
    private $daterecolte;

   

  

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
        
    public function setImageFile(File $image = Null)
    {
        $this->imageFile = $image;
//test
        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;}

    public function getPubStatut(): ?bool
    {
        return $this->pubStatut;
    }

    public function setPubStatut(bool $pubStatut): self
    {
        $this->pubStatut = $pubStatut;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNumberphone(): ?int
    {
        return $this->numberphone;
    }

    public function setNumberphone(int $numberphone): self
    {
        $this->numberphone = $numberphone;

        return $this;
    }

    public function getPublisher(): ?User
    {
        return $this->publisher;
    }

    public function setPublisher(?User $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getDaterecolte(): ?\DateTimeInterface
    {
        return $this->daterecolte;
    }

    public function setDaterecolte(\DateTimeInterface $daterecolte): self
    {
        $this->daterecolte = $daterecolte;

        return $this;
    }
    public static function getGenres()
    {
        return ['fiction', 'non-fiction'];
    }
}
