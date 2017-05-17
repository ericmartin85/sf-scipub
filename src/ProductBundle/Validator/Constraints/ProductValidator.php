<?php

namespace ProductBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ProductValidator extends ConstraintValidator
{
    public function validate($product, Constraint $constraint)
    {
        /** @var \ProductBundle\Entity\Product $product */

        $group = $product->getCategory()->getAttributeGroup();

        foreach ($product->getAttributes() as $attribute) {
            if ($attribute->getAttributeGroup() !== $group) {
                $this
                    ->context
                    ->buildViolation(
                        'Les attributs sélectionnés ne correspondent pas ' .
                        'au groupe d\'attributs de la catégorie.'
                    )
                    ->atPath('attributes')
                    ->addViolation();
            }
        }

    }
}