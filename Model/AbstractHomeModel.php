<?php

namespace exs\TcnCommonBundle\Model;

/**
 * Product Model
 *
 * Created 14-Sep-2017
 * @author Charles Weiss <charlesw@ex-situ.com>
 * @copyright   Copyright Exsitu Marketing.
 */
abstract class AbstractHomeModel
{
    /** @var  string */
    protected $name;
    /** @var  string */
    protected $url;
    /** @var  string Legal name of the website for copyrights */
    protected $legalName;
    /** @var  string Tab/Page title */
    protected $pageTitle;

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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getLegalName()
    {
        return $this->legalName;
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }
}
