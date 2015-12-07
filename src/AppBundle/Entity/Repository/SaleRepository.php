<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class SaleRepository extends EntityRepository
{
    public function getSalesByRegion($region)
    {
        $date = new \DateTime();
        $date->format('Y-m-d');
        $date->modify('-1 day');

        $qb = $this->createQueryBuilder('sale');

        $qb->where('(sale.region = :region)
            or (sale.hasTransportDelivery = true)'
        )
        ->andWhere('sale.saleDate >= :date');

        $qb->setParameter('region', $region)
            ->setParameter('date', $date);

        return new Pagerfanta(new DoctrineORMAdapter($qb));
    }

    public function getSales()
    {
        $date = new \DateTime();
        $date->format('Y-m-d');
        $date->modify('-1 day');

        $qb = $this->createQueryBuilder('sale');

        $qb->where('sale.saleDate >= :date');

        $qb->setParameter('date', $date);

        return new Pagerfanta(new DoctrineORMAdapter($qb));
    }
}