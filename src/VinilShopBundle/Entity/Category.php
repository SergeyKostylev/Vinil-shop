<?php

namespace VinilShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="VinilShopBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     */
    private $parent;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="VinilShopBundle\Entity\Product", mappedBy="category")
     */
    private $products;

    /**
     * @var Attribute_name[]
     *
     * @ORM\ManyToMany(targetEntity="VinilShopBundle\Entity\Attribute_name", inversedBy="categoryes")
     */
    private $attribute_names;


    /**
     * @return bool
     */
    public function isLastCategory()
    {
        return $this->lastCategory;
    }

    /**
     * @param bool $lastCategory
     */
    public function setLastCategory($lastCategory)
    {
        $this->lastCategory = $lastCategory;
    }

    /**
     * @var bool
     *
     * @ORM\Column(name="last_category", type="boolean")
     */
    private $lastCategory;


    public function __construct()
    {
        $this->children = new ArrayCollection();
    }


    public function getParent() {
        return $this->parent;
    }

    public function getChildren() {
        return $this->children;
    }

    public function addChild(Category $child) {
        $this->children[] = $child;
        $child->setParent($this);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set name
     *
     * @param string $parent
     *
     * @return Category
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

}

