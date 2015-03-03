<?php

namespace Ben\MyCarParkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicles")
 * @ORM\Entity(repositoryClass="Ben\MyCarParkBundle\Entity\VehicleRepository")
 */
class Vehicle
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
     * @var Driver
     *
     * @ORM\ManyToOne(targetEntity="Driver", inversedBy="vehicles")
     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
     */
    private $driver;

    /**
     * @var RegisteredOwner
     *
     * @ORM\ManyToOne(targetEntity="RegisteredOwner", inversedBy="vehicles")
     * @ORM\JoinColumn(name="registeredOwner_id", referencedColumnName="id")
     */
    private $registeredOwner;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="vehicleType", type="string", length=255)
     */
    private $vehicleType;
    
    /**
     * @var string
     *
     * @ORM\Column(name="registrationNumber", type="string", length=255)
     */
    private $registrationNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="colour", type="string", length=255)
     */
    private $colour;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfWheels", type="integer")
     */
    private $numberOfWheels;

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

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
     * Set vehicleType
     *
     * @param string $vehicleType
     * @return Vehicle
     */
    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;

        return $this;
    }

    /**
     * Get vehicleType
     *
     * @return string 
     */
    public function getVehicleType()
    {
        return $this->vehicleType;
    }
    
    /**
     * Set registrationNumber
     *
     * @param string $registrationNumber
     * @return Vehicle
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    /**
     * Get registrationNumber
     *
     * @return string 
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * Set colour
     *
     * @param string $colour
     * @return Vehicle
     */
    public function setColour($colour)
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * Get colour
     *
     * @return string 
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * Set numberOfWheels
     *
     * @param integer $numberOfWheels
     * @return Vehicle
     */
    public function setNumberOfWheels($numberOfWheels)
    {
        $this->numberOfWheels = $numberOfWheels;

        return $this;
    }

    /**
     * Get numberOfWheels
     *
     * @return integer 
     */
    public function getNumberOfWheels()
    {
        return $this->numberOfWheels;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Vehicle
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set driver
     *
     * @param \Ben\MyCarParkBundle\Entity\Driver $driver
     * @return Vehicle
     */
    public function setDriver(\Ben\MyCarParkBundle\Entity\Driver $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return \Ben\MyCarParkBundle\Entity\Driver 
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set registeredOwner
     *
     * @param \Ben\MyCarParkBundle\Entity\RegisteredOwner $registeredOwner
     * @return Vehicle
     */
    public function setRegisteredOwner(\Ben\MyCarParkBundle\Entity\RegisteredOwner $registeredOwner = null)
    {
        $this->registeredOwner = $registeredOwner;

        return $this;
    }

    /**
     * Get registeredOwner
     *
     * @return \Ben\MyCarParkBundle\Entity\RegisteredOwner 
     */
    public function getRegisteredOwner()
    {
        return $this->registeredOwner;
    }
    
    /**
     * Renders a Vehicle as a string
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getRegistrationNumber();
    }
}
