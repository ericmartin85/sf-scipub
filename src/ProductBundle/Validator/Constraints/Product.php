<?php

namespace ProductBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class Product extends Constraint
{
    public function getTargets()
    {
        return static::CLASS_CONSTRAINT;
    }
}