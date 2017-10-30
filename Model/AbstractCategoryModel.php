<?php

namespace exs\TcnCommonBundle\Model;

/**
 * Product Model
 *
 * Created 14-Sep-2017
 * @author Charles Weiss <charlesw@ex-situ.com>
 * @copyright   Copyright Exsitu Marketing.
 */
abstract class AbstractCategoryModel
{
    /** @var  string */
    protected $name;
    /** @var  string */
    protected $slug;
    /** @var  string[] */
    protected $products;
    /** @var  string Title shown on the browser tab */
    protected $pageTitle;
    /** @var  string Meta description */
    protected $metaDescription;

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
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
     * @return string[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }
}
