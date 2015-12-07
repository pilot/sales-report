<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class SaleRepository extends EntityRepository
{
    public function getSalesByRegion($region)
    {
        $qb = $this->createQueryBuilder('sale');

        $qb->where('(sale.region = :region)
            or (sale.hasTransportDelivery = true)'
        )
        ->andWhere('sale.saleDate >= CURRENT_DATE()');

        $qb->setParameter('region', $region);

        return new Pagerfanta(new DoctrineORMAdapter($qb));
    }

    public function getSales()
    {
        $qb = $this->createQueryBuilder('sale');

        $qb->where('sale.saleDate >= CURRENT_DATE()');

        return new Pagerfanta(new DoctrineORMAdapter($qb));
    }
}