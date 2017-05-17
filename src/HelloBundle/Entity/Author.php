<?php

namespace HelloBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Author
 */
class Author
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var ArrayCollection
     */
    private $posts;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $bio;


    /**
     * Author constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
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
     * Add post.
     *
     * @param Post $post
     * @return Author
     */
    public function addPost(Post $post)
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setAuthor($this);
        }

        return $this;
    }

    /**
     * Remove post.
     *
     * @param Post $post
     * @return Author
     */
    public function removePost(Post $post)
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            $post->setAuthor(null);
        }

        return $this;
    }

    /**
     * Get posts
     *
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Author
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
     * Set bio
     *
     * @param string $bio
     * @return Author
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string 
     */
    public function getBio()
    {
        return $this->bio;
    }
}
