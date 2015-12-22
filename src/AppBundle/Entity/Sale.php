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
    public static $regionDescr = array(
        'Амурская область',
        'Архангельская область',
        'Астраханская область',
        'Белгородская область',
        'Брянская область',
        'Челябинская область',
        'Иркутская область',
        'Ивановская область',
        'Калининградская область',
        'Калужская область',
        'Кемеровская область',
        'Кировская область',
        'Костромская область',
        'Курганская область',
        'Курская область',
        'Ленинградская область',
        'Липецкая область',
        'Магаданская область',
        'Московская область',
        'Мурманская область',
        'Нижегородская область',
        'Новгородская область',
        'Новосибирская область',
        'Омская область',
        'Оренбургская область',
        'Орловская область',
        'Пензенская область',
        'Псковская область',
        'Ростовская область',
        'Рязанская область',
        'Сахалинская область',
        'Самарская область',
        'Саратовская область',
        'Смоленская область',
        'Свердловская область',
        'Тамбовская область',
        'Томская область',
        'Тверская область',
        'Тульская область',
        'Тюменская область',
        'Ульяновская область',
        'Владимирская область',
        'Волгоградская область',
        'Вологодская область',
        'Воронежская область',
        'Ярославская область',
        'Алтайский край',
        'Забайкальский край',
        'Камчатский край',
        'Краснодарский край',
        'Красноярский край',
        'Пермский край',
        'Приморский край',
        'Ставропольский край',
        'Хабаровский край',
        'Ненецкий АО',
        'Ханты-Мансийский АО',
        'Чукотский АО',
        'Ямало-Ненецкий АО',
        'Еврейская АО',
        'Адыгея',
        'Алтай',
        'Башкортостан',
        'Бурятия',
        'Дагестан',
        'Ингушетия',
        'Кабардино-Балкария',
        'Калмыкия',
        'Карачаево-Черкесия',
        'Карелия',
        'Коми',
        'Крым',
        'Марий Эл',
        'Саха (Якутия)',
        'Татарстан',
        'Тыва',
        'Удмуртия',
        'Хакасия',
        'Чечня',
        'Чувашия',
        'Мордовия',
        'Северная Осетия'
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
     * @ORM\Column(name="sale_date", type="datetime", nullable=false)
     */
    protected $saleDate;

    /**
     * @ORM\Column(type="boolean", name="transport_delivery")
     */
    protected $hasTransportDelivery = false;

    /**
     * @ORM\Column(type="boolean", name="is_disabled", options={"default" = true})
     */
    protected $isDisabled = true;

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

    /**
     *
     * @param boolean $isDisabled
     * @return Sale
     */
    public function setIsDisabled($isDisabled)
    {
        $this->isDisabled = $isDisabled;

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getIsDisabled()
    {
        return $this->isDisabled;
    }
}
