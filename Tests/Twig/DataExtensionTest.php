<?php

namespace exs\TcnCommonBundle\Tests\Twig;

use exs\TcnCommonBundle\Model\AbstractCategoryModel;
use exs\TcnCommonBundle\Model\AbstractProductModel;
use exs\TcnCommonBundle\Service\TcnDataService;
use exs\TcnCommonBundle\Twig\DataExtension;

class TestCategory extends AbstractCategoryModel {
    public function __construct($name, $slug, array $products)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->products = $products;
    }
}

class TestProduct extends AbstractProductModel {
    public function __construct($name, $slug, $categorySlug)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->categorySlug = $categorySlug;
    }
}

class DataExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCategories()
    {
        $cat1 = new TestCategory('Category One', 'category-one', ['product-a', 'product-b']);
        $cat2 = new TestCategory('Category Two', 'category-two', ['product-a', 'product-c']);
        $cat3 = new TestCategory('Category Three', 'category-three', ['product-b', 'product-d']);
        $cat4 = new TestCategory('Category Four', 'category-four', ['product-b']);
        $cat5 = new TestCategory('Category Five', 'category-five', ['product-b']);

        $categories = [
            'category-one' => $cat1,
            'category-two' => $cat2,
            'category-three' => $cat3,
            'category-four' => $cat4,
            'category-five' => $cat5,
        ];

        $product = new TestProduct('Product B', 'product-b', 'category-three');

        $tcnDataService = $this->prophesize(TcnDataService::class);
        $tcnDataService->getCategories()->willReturn($categories)->shouldBeCalledTimes(1);

        $extension = new DataExtension($tcnDataService->reveal());

        $result = $extension->getCategories($product);

        $this->assertCount(4, $result);
        reset($result);
        $this->assertEquals('Category Three', current($result)->getName());
    }
}
