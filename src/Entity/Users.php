<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Users
 * @package App\Entity
 * @ORM\Entity()
 */
class Users
{

    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="username", type="string")
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(name="surname", type="string", nullable=true)
     */
    private $surname;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $dudaVoter;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @var Category
     */
    private $category;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return bool
     */
    public function isDudaVoter(): ?bool
    {
        return $this->dudaVoter;
    }

    /**
     * @param bool $dudaVoter
     */
    public function setDudaVoter(bool $dudaVoter): void
    {
        $this->dudaVoter = $dudaVoter;
    }


}