<?php

namespace Ben\MyCarParkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Driver
 *
 * @ORM\Table(name="drivers")
 * @ORM\Entity(repositoryClass="Ben\MyCarParkBundle\Entity\DriverRepository")
 */
class Driver
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
     * @ORM\OneToMany(targetEntity="Vehicle", mappedBy="driver")
     */
    private $vehicles;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="drivingLicenseNumber", type="string", length=255)
     */
    private $drivingLicenseNumber;
    
    /**
     * Constructor
     */
    private function __construct()
    {
        $this->vehicles = new ArrayCollection();
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
     * @return Driver
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
     * Set drivingLicenseNumber
     *
     * @param string $drivingLicenseNumber
     * @return Driver
     */
    public function setDrivingLicenseNumber($drivingLicenseNumber)
    {
        $this->drivingLicenseNumber = $drivingLicenseNumber;

        return $this;
    }

    /**
     * Get drivingLicenseNumber
     *
     * @return string 
     */
    public function getDrivingLicenseNumber()
    {
        return $this->drivingLicenseNumber;
    }

    /**
     * Add vehicles
     *
     * @param \Ben\MyCarParkBundle\Entity\Vehicle $vehicles
     * @return Driver
     */
    public function addVehicle(\Ben\MyCarParkBundle\Entity\Vehicle $vehicles)
    {
        $this->vehicles[] = $vehicles;

        return $this;
    }

    /**
     * Remove vehicles
     *
     * @param \Ben\MyCarParkBundle\Entity\Vehicle $vehicles
     */
    public function removeVehicle(\Ben\MyCarParkBundle\Entity\Vehicle $vehicles)
    {
        $this->vehicles->removeElement($vehicles);
    }

    /**
     * Get vehicles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }
    
    /**
     * Renders a Driver as a string
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
