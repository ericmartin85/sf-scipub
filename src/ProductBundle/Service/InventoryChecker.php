<?php

namespace ProductBundle\Service;

use Doctrine\ORM\EntityManagerInterface;

class InventoryChecker implements InventoryCheckerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var int
     */
    private $defaultMin;

    /**
     * InventoryChecker constructor.
     *
     * @param EntityManagerInterface $em
     * @param int                    $defaultMin
     */
    public function __construct(EntityManagerInterface $em, $defaultMin = 0)
    {
        $defaultMin = intval($defaultMin);
        if (0 > $defaultMin) {
            throw new \InvalidArgumentException('The default minimum must be greater than or equals zero.');
        }

        $this->em = $em;
        $this->defaultMin = $defaultMin;
    }

    /**
     * @inheritdoc
     */
    public function check($min = null)
    {
        if (is_null($min)) {
            $min = $this->defaultMin;
        }

        $qb = $this->em->createQueryBuilder();
        $query = $qb
            ->from('ProductBundle\Entity\Product', 'p')
            ->select('p')
            ->where('p.stock <= :min')
            //->where($qb->expr()->lte('p.stock', ':min'))
            ->getQuery();

        $products = $query
            ->setParameter('min', $min)
            ->getResult();

        return $products;
    }
}