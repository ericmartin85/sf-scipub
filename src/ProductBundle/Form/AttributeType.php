<?php

namespace ProductBundle\Form;

use ProductBundle\Entity\Attribute;
use ProductBundle\Entity\AttributeGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttributeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom',
            ])
            ->add('attributeGroup', EntityType::class, [
                'label'        => 'Groupe d\'attributs',
                'class'        => AttributeGroup::class,
                'choice_label' => 'name',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Attribute::class,
        ));
    }
}
