<?php

namespace ProductBundle\Form;

use ProductBundle\Entity\AttributeGroup;
use ProductBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
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
            ])
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
            'data_class' => Category::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'productbundle_category';
    }


}
