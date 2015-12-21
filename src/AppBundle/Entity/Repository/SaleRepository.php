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
            ->andWhere('sale.saleDate >= CURRENT_DATE()')
            ->andWhere('sale.isDisabled = false')
            ->orderBy('sale.id', 'DESC');

        $qb->setParameter('region', $region);

        return new Pagerfanta(new DoctrineORMAdapter($qb));
    }

    public function getSales($getDisabled)
    {
        $qb = $this->createQueryBuilder('sale');

        $qb->where('sale.saleDate >= CURRENT_DATE()');
        if ($getDisabled) {
            $qb->andWhere('sale.isDisabled = true');
        }
        $qb->orderBy('sale.id', 'DESC');

        return new Pagerfanta(new DoctrineORMAdapter($qb));
    }
}
