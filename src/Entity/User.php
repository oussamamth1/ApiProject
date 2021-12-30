<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(formats={"json"},
 * collectionOperations={
 *           "post",
 *          "get"={"normalization_context"={"groups"="read"}},
 *     },
 *   normalizationContext={"groups"={"get"}},
 *     itemOperations={
 *         "put",
 *          "patch",
 *           "delete",
 *         "get"={
 *             "normalization_context"={"groups"={"read_details"}}
 *         }
 *     })
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
  use ResourceId;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"read_details","read","Artical_read_details"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;
    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity=Artical::class, mappedBy="Author")
     * @Groups({"read_details"})
     */
    private $articals;

    public function __construct()
    {
        $this->articals = new ArrayCollection();
        $this->createdAt=new \DateTimeImmutable();
    }

 

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }
     /**
    *@return mixed 
   */
	function getPlainPassword() { 
                                return $this->plainPassword; 
                                 } 
      /**
      *@return mixed $planPassword
     */
      function setPlainPassword($plainPassword):void { 
            $this->plainPassword=$plainPassword; 
      }

      /**
       * @return Collection|Artical[]
       */
      public function getArticals(): Collection
      {
          return $this->articals;
      }

      public function addArtical(Artical $artical): self
      {
          if (!$this->articals->contains($artical)) {
              $this->articals[] = $artical;
              $artical->setAuthor($this);
          }

          return $this;
      }

      public function removeArtical(Artical $artical): self
      {
          if ($this->articals->removeElement($artical)) {
              // set the owning side to null (unless already changed)
              if ($artical->getAuthor() === $this) {
                  $artical->setAuthor(null);
              }
          }

          return $this;
      }
   
}
