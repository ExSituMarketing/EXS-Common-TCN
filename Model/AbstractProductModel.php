<?php

namespace exs\TcnCommonBundle\Model;

/**
 * Product Model
 *
 * Created 14-Sep-2017
 * @author Charles Weiss <charlesw@ex-situ.com>
 * @copyright   Copyright Exsitu Marketing.
 */
abstract class AbstractProductModel
{
    /** @var  string */
    protected $name;
    /** @var  string */
    protected $slug;
    /** @var  string */
    protected $tourlink;
    /** @var  string Main category slug of the product */
    protected $categorySlug = null;
    /** @var  string Main category of the product (model) */
    protected $category;
    /** @var bool Whether site link should be hidden or not */
    protected $openSite = true;

    /**
     * @return bool
     */
    public function isOpenSite()
    {
        return $this->openSite;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getTourlink()
    {
        return $this->tourlink;
    }

    /**
     * @return string
     */
    public function getCategorySlug()
    {
        return $this->categorySlug;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
}
