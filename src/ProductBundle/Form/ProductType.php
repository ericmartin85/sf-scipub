<?php

namespace ProductBundle\Form;

use ProductBundle\Entity\Attribute;
use ProductBundle\Entity\Category;
use ProductBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation', null, [
                'label' => 'Désignation',
            ])
            ->add('category', EntityType::class, [
                'class'        => Category::class,
                'choice_label' => 'name',
            ])
            ->add('attributes', EntityType::class, [
                'label'        => 'Attributs',
                'class'        => Attribute::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded'     => true,
            ])
            ->add('price', Type\NumberType::class, [
                'label'     => 'Prix',
                'precision' => 2,
            ])
            ->add('stock', Type\IntegerType::class, [
                'precision' => 2,
            ])
            ->add('description', Type\TextareaType::class)
            ->add('seo', SeoType::class, [
                'label' => 'Référencement',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class,
        ));
    }
}
