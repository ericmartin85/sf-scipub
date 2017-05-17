<?php

namespace ProductBundle\Entity;

use Behat\Transliterator\Transliterator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * Category
 */
class Category
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var AttributeGroup
     */
    private $attributeGroup;

    /**
     * @var Seo
     */
    private $seo;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var ArrayCollection
     */
    private $products;


    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->seo = new Seo();
        $this->products = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get attribute group.
     *
     * @return AttributeGroup
     */
    public function getAttributeGroup()
    {
        return $this->attributeGroup;
    }

    /**
     * Set attribute group.
     *
     * @param AttributeGroup $attributeGroup
     *
     * @return Category
     */
    public function setAttributeGroup(AttributeGroup $attributeGroup)
    {
        $this->attributeGroup = $attributeGroup;

        return $this;
    }

    /**
     * @return Seo
     */
    public function getSeo()
    {
        return $this->seo;
    }

    /**
     * @param Seo $seo
     * @return Category
     */
    public function setSeo(Seo $seo)
    {
        $this->seo = $seo;
        return $this;
    }

    /**
     * Adds the product.
     * @param Product $product
     * @return $this
     */
    public function addProduct(Product $product)
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setCategory($this);
        }

        return $this;
    }

    /**
     * Removes the product.
     * @param Product $product
     * @return $this
     */
    public function removeProduct(Product $product)
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            $product->setCategory(null);
        }

        return $this;
    }

    /**
     * Returns the products.
     *
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Pre persist lifecycle callback.
     *
     * @param LifecycleEventArgs $eventArgs
     */
    public function onPrePersist(LifecycleEventArgs $eventArgs)
    {
        $this->generateSlug();
    }

    /**
     * Pre update lifecycle callback.
     *
     * @param PreUpdateEventArgs $eventArgs
     */
    public function onPreUpdate(PreUpdateEventArgs $eventArgs)
    {
        $this->generateSlug();
    }

    /**
     * Generates the slug.
     */
    private function generateSlug()
    {
        $this->slug = Transliterator::urlize($this->name);
    }
}
