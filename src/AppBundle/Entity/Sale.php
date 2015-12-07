<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SaleRepository")
 * @ORM\Table(name="ostrov_sale")
 */
class Sale
{
    const AMURSKA = 1;
    const ARHANGELSKA = 2;
    const ASTRAHANSKA = 3;
    const BELGORODSKA = 4;
    const BRYANSKA = 5;
    const CHELYABINSKA = 6;
    const IRKUTSKA = 7;
    const IVANOVSKA = 8;
    const KALININGRADSKA = 9;
    const KALUZHSKA = 10;
    const KEMEROVSKA = 11;
    const KIROVSKA = 12;
    const KOSTROMSKA = 13;
    const KURGANSKA = 14;
    const KURSKA = 15;
    const LENINGRADSKA = 16;
    const LIPECKA = 17;
    const MAGADANSKA = 18;
    const MOSKOVSKA = 19;
    const MURMANSKA = 20;
    const NIZHEGORODSKA = 21;
    const NOVGORODSKA = 22;
    const NOVOSIBIRSKA = 23;
    const OMSKA = 24;
    const ORENBURGSKA = 25;
    const ORLOVSKA = 26;
    const PENZENSKA = 27;
    const PSKOVSKA = 28;
    const ROSTOVSKA = 29;
    const RYAZANSKA = 30;
    const SAHALINSKA = 31;
    const SAMARSKA = 32;
    const SARATOVSKA = 33;
    const SMOLENSKA = 34;
    const SVERDLOVSKA = 35;
    const TAMBOVSKA = 36;
    const TOMSKA = 37;
    const TVERSKA = 38;
    const TULSKA = 39;
    const TYUMENSKA = 40;
    const ULYANOVSKA = 41;
    const VLADIMIRSKA = 42;
    const VOLGOGRADSKA = 43;
    const VOLOGODSKA = 44;
    const VORONEZHSKA = 45;
    const YAROSLAVSKA = 46;

    public static $regionDescr = array(
        self::AMURSKA => 'Амурская область',
        self::ARHANGELSKA => 'Архангельская область',
        self::ASTRAHANSKA => 'Астраханская область',
        self::BELGORODSKA => 'Белгородская область',
        self::BRYANSKA => 'Брянская область',
        self::CHELYABINSKA => 'Челябинская область',
        self::IRKUTSKA => 'Иркутская область',
        self::IVANOVSKA => 'Ивановская область',
        self::KALININGRADSKA => 'Калининградская область',
        self::KALUZHSKA => 'Калужская область',
        self::KEMEROVSKA => 'Кемеровская область',
        self::KIROVSKA => 'Кировская область',
        self::KOSTROMSKA => 'Костромская область',
        self::KURGANSKA => 'Курганская область',
        self::KURSKA => 'Курская область',
        self::LENINGRADSKA => 'Ленинградская область',
        self::LIPECKA => 'Липецкая область',
        self::MAGADANSKA => 'Магаданская область',
        self::MOSKOVSKA => 'Московская область',
        self::MURMANSKA => 'Мурманская область',
        self::NIZHEGORODSKA => 'Нижегородская область',
        self::NOVGORODSKA => 'Новгородская область',
        self::NOVOSIBIRSKA => 'Новосибирская область',
        self::OMSKA => 'Омская область',
        self::ORENBURGSKA => 'Оренбургская область',
        self::ORLOVSKA => 'Орловская область',
        self::PENZENSKA => 'Пензенская область',
        self::PSKOVSKA => 'Псковская область',
        self::ROSTOVSKA => 'Ростовская область',
        self::RYAZANSKA => 'Рязанская область',
        self::SAHALINSKA => 'Сахалинская область',
        self::SAMARSKA => 'Самарская область',
        self::SARATOVSKA => 'Саратовская область',
        self::SMOLENSKA => 'Смоленская область',
        self::SVERDLOVSKA => 'Свердловская область',
        self::TAMBOVSKA => 'Тамбовская область',
        self::TOMSKA => 'Томская область',
        self::TVERSKA => 'Тверская область',
        self::TULSKA => 'Тульская область',
        self::TYUMENSKA => 'Тюменская область',
        self::ULYANOVSKA => 'Ульяновская область',
        self::VLADIMIRSKA => 'Владимирская область',
        self::VOLGOGRADSKA => 'Волгоградская область',
        self::VOLOGODSKA => 'Вологодская область',
        self::VORONEZHSKA => 'Воронежская область',
        self::YAROSLAVSKA => 'Ярославская область');

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
