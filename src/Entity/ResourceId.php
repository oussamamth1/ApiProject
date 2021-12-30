<?php
declare(strict_types=1);
namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

trait ResourceId{
        /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read_details","read","Artical_read_details","Artical_read"})
     */
    private $id;
    public function getId(): ?int
    {
        return $this->id;
    }
}