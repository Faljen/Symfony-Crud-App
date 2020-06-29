<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Category
 * @package App\Entity
 * @ORM\Entity()
 * @UniqueEntity(fields={"name"})
 */
class Category
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Id()
     */
    private $id;

    /**
     * @Assert\Length(min="3", max="30")
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Users", mappedBy="category")
     * @var Users[]|Collection
     */
    private $users;

    public function __construct($name)
    {
        $this->users = new ArrayCollection();
        $this->name = $name;
    }

    public function addUserToCategory(Users $user)
    {
        $user->setCategory($this);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}