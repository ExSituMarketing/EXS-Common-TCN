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
}
