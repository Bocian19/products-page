<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\GeneratedValue;


/**
 * @Entity
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"product" = "AbstractProduct", "dvd" = "Dvd", "furniture" = "Furniture",
 * "book" = "Book"})
 */
abstract class AbstractProduct
{
    /** 
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string", unique=true) */
    private string $sku;

    /** @Column(type="string") */
    private string $name;

    /** @Column(type="decimal", precision=8, scale=2) */
    private float $price;

    /** @Column(type="array") */
    protected array $data;

    // public abstract function createProduct(): AbstractProduct;

    /**
     * Get the value of sku
     */ 
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set the value of sku
     *
     * @return  self
     */ 
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = ucfirst($name);

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price.' $';
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = number_format($price, 2);

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     */ 
    abstract function setData(array $data);
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

}
