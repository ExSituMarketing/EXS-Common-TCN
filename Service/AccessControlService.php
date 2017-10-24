<?php

namespace exs\TcnCommonBundle\Service;

/**
 * Class AccessControlService
 * @package exs\TcnCommonBundle\Service
 */
class AccessControlService
{
    /**
     * @var TcnDataService
     */
    protected $dataService;
    /**
     * @var array
     */
    protected $data;

    /**
     * TcnDataService constructor.
     * @param \Memcached $memcached
     * @param string $basePath
     * @param string $namespace
     * @param string $cacheKey
     */
    public function __construct(TcnDataService $dataService)
    {
        $this->dataService = $dataService;
        $this->data = $dataService->getAllData();
    }

    /**
     * @param $categorySlug
     * @param $reviewSlug
     * @return bool
     */
    public function isReviewAvailable($categorySlug,$reviewSlug){
        return
            // the category exists
            array_key_exists($categorySlug, $this->data['categories'])
            // the site exists
            && array_key_exists($reviewSlug, $this->data['sites'])
            // the site has a review
            && strlen($this->data['sites'][$reviewSlug]->getContent()) > 0
            // the site belongs to the category
            && (in_array($reviewSlug, $this->data['categories'][$categorySlug]->getSites())
                // or the category belongs to the site (site could have changed category)
                ||array_key_exists($this->data['sites'][$reviewSlug]->getCategorySlug(), $this->data['categories']))
            // the site does not have a new slug
            && null === $this->data['sites'][$reviewSlug]->getNewSlug();
    }

    /**
     * @param $reviewSlug
     * @return bool
     */
    public function isNewReviewAvailable($reviewSlug){
        return
            // the site exists
            array_key_exists($reviewSlug, $this->data['sites'])
            // the site has a new slug
            && strlen($this->data['sites'][$reviewSlug]->getNewSlug())> 0
            // the new slug exists
            && array_key_exists($this->data['sites'][$reviewSlug]->getNewSlug(), $this->data['sites'])
            // the new slug has a category
            && null !== $this->data['sites'][$this->data['sites'][$reviewSlug]->getNewSlug()]->getCategory();
    }

    /**
     * @param $slug
     * @return bool
     */
    public function isLanguageAvailable($slug){
        return array_key_exists($slug,$this->data['languages']);
    }

    /**
     * @param $categorySlug
     * @return bool
     */
    public function isCategoryAvailable($categorySlug){
        return array_key_exists($categorySlug,$this->data['categories']);
    }
}