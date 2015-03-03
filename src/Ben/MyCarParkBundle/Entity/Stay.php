<?php

namespace Ben\MyCarParkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stay
 *
 * @ORM\Table(name="stays")
 * @ORM\Entity(repositoryClass="Ben\MyCarParkBundle\Entity\StayRepository")
 */
class Stay
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
     * @var CarPark
     *
     * @ORM\ManyToOne(targetEntity="CarPark", inversedBy="stays")
     * @ORM\JoinColumn(name="carPark_id", referencedColumnName="id")
     */
    private $carPark;

    /**
     * @var Vehicle
     *
     * @ORM\OneToOne(targetEntity="Vehicle")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     */
    private $vehicle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entryTime", type="datetime")
     */
    private $entryTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="exitByTime", type="datetime")
     */
    private $exitByTime;

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
     * Set entryTime
     *
     * @param \DateTime $entryTime
     * @return Stay
     */
    public function setEntryTime($entryTime)
    {
        $this->entryTime = $entryTime;

        return $this;
    }

    /**
     * Get entryTime
     *
     * @return \DateTime 
     */
    public function getEntryTime()
    {
        return $this->entryTime;
    }

    /**
     * Set exitByTime
     *
     * @param \DateTime $exitByTime
     * @return Stay
     */
    public function setExitByTime($exitByTime)
    {
        $this->exitByTime = $exitByTime;

        return $this;
    }

    /**
     * Get exitByTime
     *
     * @return \DateTime 
     */
    public function getExitByTime()
    {
        return $this->exitByTime;
    }

    /**
     * Set carPark
     *
     * @param \Ben\MyCarParkBundle\Entity\CarPark $carPark
     * @return Stay
     */
    public function setCarPark(\Ben\MyCarParkBundle\Entity\CarPark $carPark = null)
    {
        $this->carPark = $carPark;

        return $this;
    }

    /**
     * Get carPark
     *
     * @return \Ben\MyCarParkBundle\Entity\CarPark 
     */
    public function getCarPark()
    {
        return $this->carPark;
    }

    /**
     * Set vehicle
     *
     * @param \Ben\MyCarParkBundle\Entity\Vehicle $vehicle
     * @return Stay
     */
    public function setVehicle(\Ben\MyCarParkBundle\Entity\Vehicle $vehicle = null)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get vehicle
     *
     * @return \Ben\MyCarParkBundle\Entity\Vehicle 
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }
}