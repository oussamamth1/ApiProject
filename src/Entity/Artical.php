<?php
declare(strict_types=1);
namespace App\Entity;



use App\Entity\Timestampable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticalRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ArticalsUpdatedAtController;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ArticalRepository::class)
 * @ApiResource(
 * collectionOperations={
 *           "post",
 *          "get"={"normalization_context"={"groups"="Artical_read"}},
 *     },
 *   normalizationContext={"groups"={"get"}},
 *     itemOperations={
 *         "put",
 *          "patch",
 *           "delete",
 *  "put_updateAt"={
 *         "method"="PUT",
 *         "path"="/articals/{id}/updated_at",
 *         "controller"=ArticalsUpdatedAtController::class,
 * "normalization_context"={"groups"={"publication"}} ,
 *         
 *     },
 *         "get"={
 *             "normalization_context"={"groups"={"Artical_read_details"}}
 *         },
 
 *     })
 */
class Artical
{ 
use Timestampable;
use ResourceId;
    // /**
    //  * @ORM\Id
    //  * @ORM\GeneratedValue
    //  * @ORM\Column(type="integer")
    //  *  @Groups({"Artical_read_details","Artical_read"})
    //  */
    // private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read_details","Artical_read_details"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articals")
     * @Groups({"Artical_read_details"})
     * 
     */
    private $Author;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function __construct()
    {
       
        $this->createdAt=new \DateTimeImmutable();
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->Author;
    }

    public function setAuthor(?User $Author): self
    {
        $this->Author = $Author;

        return $this;
    }
    
}
