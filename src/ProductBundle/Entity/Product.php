<?php

namespace ProductBundle\Entity;

use Behat\Transliterator\Transliterator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * Product
 */
class Product
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Seo
     */
    private $seo;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var ArrayCollection
     */
    private $attributes;

    /**
     * @var string
     */
    private $designation;

    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $price;

    /**
     * @var int
     */
    private $stock;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $slug;


    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->seo = new Seo();
        $this->attributes = new ArrayCollection();
        $this->createdAt = new \DateTime();
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
     * @return Seo
     */
    public function getSeo()
    {
        return $this->seo;
    }

    /**
     * @param Seo $seo
     * @return Product
     */
    public function setSeo(Seo $seo)
    {
        $this->seo = $seo;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Product
     */
    public function setCategory(Category $category = null)
    {
        if ($category !== $this->category) {
            $this->category = $category;

            if (!$category) {
                $category->addProduct($this);
            }
        }

        return $this;
    }

    /**
     * Adds the attribute.
     * @param Attribute $attribute
     * @return $this
     */
    public function addAttribute(Attribute $attribute)
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes->add($attribute);
        }

        return $this;
    }

    /**
     * Removes the attribute.
     * @param Attribute $attribute
     * @return $this
     */
    public function removeAttribute(Attribute $attribute)
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return $this
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set stock
     *
     * @param int $stock
     * @return Product
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set created at
     *
     * @param \DateTime $createdAt
     * @return Product
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get created at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * @return Product
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
        $this->slug = Transliterator::urlize($this->designation);
    }
}
