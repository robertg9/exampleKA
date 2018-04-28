<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator as AppAssert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id = 0;

    /**
     * @Assert\Length(min=3, max="20", minMessage="firstname_to_short", maxMessage="firstname_to_long")
     * @Assert\Regex(
     *     pattern = "/^[a-zążźćńóęśł]+$/i",
     *     message="firstname_illegal_characters"
     * )
     *
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=20)
     */
    private $firstName = '';

    /**
     * @Assert\Length(min=3, max="50", minMessage="lastname_to_short", maxMessage="lastname_to_long")
     * @Assert\Regex(
     *     pattern = "/^[a-zążźćńóęśł]+$/i",
     *     message="lastname_illegal_characters"
     * )
     *
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=50)
     */
    private $lastName = '';

    /**
     * @Assert\Regex(
     *     pattern = "/^[0-9]{1,2}+$/",
     *     message="experience_not_number"
     * )
     * @var int
     *
     * @ORM\Column(name="experience", type="smallint")
     */
    private $experience;

    /**
     * @Assert\Length(min=3, max="50", minMessage="city_to_short", maxMessage="city_to_long")
     *
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50)
     */
    private $city = '';

    /**
     * @AppAssert\ArrayNotEmpty(message="availability_not_selected")
     *
     * @var Availability[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Availability")
     */
    private $availabilities;

    /**
     * @Assert\NotNull(message="occupation_not_selected")
     *
     * @var Occupation
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Occupation")
     */
    private $occupation;

    /**
     * @Assert\NotNull(message="country_not_selected")
     *
     * @var Country
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Country")
     */
    private $country;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return int
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param int $experience
     * @return User
     */
    public function setExperience($experience): User
    {
        $this->experience = $experience;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return User
     */
    public function setCity(string $city): User
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return Availability[]|ArrayCollection
     */
    public function getAvailabilities()
    {
        return $this->availabilities;
    }

    /**
     * @param Availability[] $availabilities
     * @return User
     */
    public function setAvailabilities($availabilities): User
    {
        $this->availabilities = $availabilities;
        return $this;
    }

    /**
     * @return Occupation
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param Occupation $occupation
     * @return User
     */
    public function setOccupation(Occupation $occupation): User
    {
        $this->occupation = $occupation;
        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param Country $country
     * @return User
     */
    public function setCountry(Country $country): User
    {
        $this->country = $country;
        return $this;
    }

}
