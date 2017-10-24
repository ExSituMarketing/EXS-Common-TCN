<?php

namespace exs\TcnCommonBundle\Twig;

use exs\TcnCommonBundle\Model\AbstractCategoryModel;
use exs\TcnCommonBundle\Model\AbstractProductModel;
use exs\TcnCommonBundle\Service\TcnDataService;

/**
 * Class DataExtension
 *
 * @package exs\TcnCommonBundle\Twig
 */
class DataExtension extends \Twig_Extension
{
    /**
     * @var TcnDataService
     */
    private $dataService;

    /**
     * DataExtension constructor.
     *
     * @param TcnDataService $dataService
     */
    public function __construct(TcnDataService $dataService)
    {
        $this->dataService = $dataService;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('getCategories', [$this, 'getCategories']),
        ];
    }

    /**
     * @param AbstractProductModel $product
     *
     * @return mixed
     */
    public function getCategories(AbstractProductModel $product)
    {
        $categories = $this->dataService->getCategories();

        /** Keep only categories having a specific product. */
        $categories = array_filter($categories, function ($category) use ($product) {
            /** @var AbstractCategoryModel $category */
            return in_array($product->getSlug(), $category->getProducts());
        });

        /** Set main category first of the collection. */
        uasort($categories, function ($next, $prev) use ($product) {
            /** @var AbstractCategoryModel $category */
            if ($next->getSlug() == $product->getCategorySlug()) {
                return -1;
            }

            return 1;
        });

        return $categories;
    }
}
