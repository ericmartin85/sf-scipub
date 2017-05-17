<?php

namespace ProductBundle\Service;

interface InventoryCheckerInterface
{
    /**
     * Returns the products whose stock is less than or equals the given minimum.
     *
     * @param int $min
     *
     * @return array|\ProductBundle\Entity\Product[]
     */
    public function check($min = null);
}