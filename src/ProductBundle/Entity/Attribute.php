<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Attribute
 */
class Attribute
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
     * @var ArrayCollection
     */
    private $products;

    /**
     * @var string
     */
    private $name;

    
    /**
     * Attribute constructor.
     */
    public function __construct()
    {
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
     * @return Attribute
     */
    public function setAttributeGroup(AttributeGroup $attributeGroup)
    {
        $this->attributeGroup = $attributeGroup;

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
            $product->addAttribute($this);
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
            $product->removeAttribute($this);
        }

        return $this;
    }

    /**
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
     * @return Attribute
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
}
