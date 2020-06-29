<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Imię nie może być puste")
     * @Assert\Length(min="3", max="13")
     * @var string
     * @ORM\Column(name="username", type="string")
     */
    private $name;

    /**
     * @Assert\NotBlank(message="Nazwisko nie może być puste")
     * @Assert\Length(min="3", max="20")
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
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="To pole nie może być puste")
     * @Assert\Country()
     */
    private $country;

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
    public function getCategory(): ?Category
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

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }


}