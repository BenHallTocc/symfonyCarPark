<?php

namespace Ben\MyCarParkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CarPark
 *
 * @ORM\Table(name="car_parks")
 * @ORM\Entity(repositoryClass="Ben\MyCarParkBundle\Entity\CarParkRepository")
 */
class CarPark
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Stay", mappedBy="carPark")
     */
    private $stays;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * 
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxHeight", type="integer")
     * 
     * @Assert\NotNull()
     */
    private $maxHeight;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfCarSpaces", type="integer")
     * 
     * @Assert\NotNull()
     */
    private $numberOfCarSpaces;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfLorrySpaces", type="integer")
     * 
     * @Assert\NotNull()
     */
    private $numberOfLorrySpaces;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfMotorbikeSpaces", type="integer")
     * 
     * @Assert\NotNull()
     */
    private $numberOfMotorbikeSpaces;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxStay", type="integer")
     * 
     * @Assert\Range(
     *      min = 1,
     *      minMessage = "You will need to select 1 or greater."
     * )
     */
    private $maxStay;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stays = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return CarPark
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set maxHeight
     *
     * @param integer $maxHeight
     * @return CarPark
     */
    public function setMaxHeight($maxHeight)
    {
        $this->maxHeight = $maxHeight;

        return $this;
    }

    /**
     * Get maxHeight
     *
     * @return integer 
     */
    public function getMaxHeight()
    {
        return $this->maxHeight;
    }

    /**
     * Set numberOfCarSpaces
     *
     * @param integer $numberOfCarSpaces
     * @return CarPark
     */
    public function setNumberOfCarSpaces($numberOfCarSpaces)
    {
        $this->numberOfCarSpaces = $numberOfCarSpaces;

        return $this;
    }

    /**
     * Get numberOfCarSpaces
     *
     * @return integer 
     */
    public function getNumberOfCarSpaces()
    {
        return $this->numberOfCarSpaces;
    }

    /**
     * Set numberOfLorrySpaces
     *
     * @param integer $numberOfLorrySpaces
     * @return CarPark
     */
    public function setNumberOfLorrySpaces($numberOfLorrySpaces)
    {
        $this->numberOfLorrySpaces = $numberOfLorrySpaces;

        return $this;
    }

    /**
     * Get numberOfLorrySpaces
     *
     * @return integer 
     */
    public function getNumberOfLorrySpaces()
    {
        return $this->numberOfLorrySpaces;
    }

    /**
     * Set numberOfMotorbikeSpaces
     *
     * @param integer $numberOfMotorbikeSpaces
     * @return CarPark
     */
    public function setNumberOfMotorbikeSpaces($numberOfMotorbikeSpaces)
    {
        $this->numberOfMotorbikeSpaces = $numberOfMotorbikeSpaces;

        return $this;
    }

    /**
     * Get numberOfMotorbikeSpaces
     *
     * @return integer 
     */
    public function getNumberOfMotorbikeSpaces()
    {
        return $this->numberOfMotorbikeSpaces;
    }

    /**
     * Set maxStay
     *
     * @param integer $maxStay
     * @return CarPark
     */
    public function setMaxStay($maxStay)
    {
        $this->maxStay = $maxStay;

        return $this;
    }

    /**
     * Get maxStay
     *
     * @return integer 
     */
    public function getMaxStay()
    {
        return $this->maxStay;
    }

    /**
     * Add stays
     *
     * @param \Ben\MyCarParkBundle\Entity\Stay $stays
     * @return CarPark
     */
    public function addStay(\Ben\MyCarParkBundle\Entity\Stay $stays)
    {
        $this->stays[] = $stays;

        return $this;
    }

    /**
     * Remove stays
     *
     * @param \Ben\MyCarParkBundle\Entity\Stay $stays
     */
    public function removeStay(\Ben\MyCarParkBundle\Entity\Stay $stays)
    {
        $this->stays->removeElement($stays);
    }

    /**
     * Get stays
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStays()
    {
        return $this->stays;
    }
    
    /**
     * Render a CarPark as a string
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
