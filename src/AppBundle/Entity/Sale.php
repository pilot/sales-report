<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="ostrov_sale")
 */
class Sale
{
    const moskow = 1;
    const ekb = 2;
    const vlad = 3;
    const peter = 4;

    public static $regionDescr = array(
        self::moskow => 'Москва',
        self::ekb => 'Екатеринбург',
        self::vlad => 'Владивосток',
        self::peter => 'Санкт-Петербург',
    );

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="region", type="integer", nullable=false)
     */
    protected $region;

    /**
     * @ORM\Column(name="link", type="string", length=255)
     */
    protected $link;

    /**
     * @ORM\Column(name="sale_date", type="string", nullable=false)
     */
    protected $saleDate;

    /**
     * @ORM\Column(type="boolean", name="transport_delivery")
     */
    protected $hasTransportDelivery = false;

    public function __construct()
    {
        $this->saleDate = new \DateTime();
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
     * @param  integer
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return integer
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string
     * @return Sale
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getSaleDate()
    {
        return $this->saleDate;
    }

    /**
     * @param string $saleDate
     */
    public function setSaleDate($saleDate)
    {
        $this->saleDate = $saleDate;
    }

    /**
     *
     * @param boolean $hasTransportDelivery
     * @return Sale
     */
    public function setHasTransportDelivery($hasTransportDelivery)
    {
        $this->hasTransportDelivery = $hasTransportDelivery;

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getHasTransportDelivery()
    {
        return $this->hasTransportDelivery;
    }
}
