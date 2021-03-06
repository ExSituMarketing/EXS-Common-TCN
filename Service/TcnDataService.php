<?php

namespace exs\TcnCommonBundle\Service;

use AppBundle\Data\ProductModel;
use exs\TcnCommonBundle\Model\AbstractProductModel;
use Symfony\Component\Finder\Finder;
/**
 * Created by PhpStorm.
 * User: damiend
 * Date: 2017-09-15
 * Time: 11:09 AM
 */
class TcnDataService
{
    protected $basePath;
    protected $namespace;
    protected $cacheKey;

    /**
     * TcnDataService constructor.
     * @param string $basePath
     * @param string $namespace
     * @param string $cacheKey
     */
    public function __construct($basePath, $namespace, $cacheKey)
    {
        $this->cacheKey = $cacheKey;
        $this->basePath = $basePath;
        $this->namespace = $namespace;
    }

    /**
     * @return array|mixed
     */
    public function getAllData()
    {
        $cats = $this->getCategories();
        $data = [
            'home' => $this->getHome(),
            'categories' => $cats,
            'products' => $this->getProducts($cats),
            'handlers' => $this->getHandlers(),
            'languages' => $this->getLanguages(),
        ];

        return $data;
    }

    /**
     * @return array
     */
    public function getLanguages()
    {
        return $this->associateToSlug($this->getData('AbstractLanguageModel', 'Language'));
    }

    /**
     * @return array
     */
    public function getHandlers()
    {
        return $this->associateToSlug($this->getData('AbstractHandlerModel', 'Handler'));
    }

    /**
     * @return mixed
     */
    public function getHome()
    {
        return current($this->getData('AbstractHomeModel', ''));
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->associateToSlug($this->getData('AbstractCategoryModel', 'Category'));
    }

    /**
     * @param array $cats
     * @return array
     */
    public function getProducts($cats = array())
    {
        $sites = $this->associateToSlug($this->getData('AbstractProductModel', 'Product'));

        foreach ($sites as $x => $site) {
            $sites[$x]->setCategory($this->getCatFromSite($cats, $site));
        }
        return $sites;
    }

    /**
     * @param array $items
     * @return array
     */
    public function associateToSlug($items = array())
    {
        $bySlug = [];
        if (!empty($items)) {
            foreach ($items as $item) {
                $bySlug[$item->getSlug()] = $item;
            }
        }
        return $bySlug;
    }

    /**
     * @param string $model
     * @param string $dataDir
     * @return array
     */
    public function getData($model = '', $dataDir = '')
    {
        $models = [];
        $path = $this->basePath . $dataDir;

        $finder = new Finder();
        try {
            $finder->files()->name('*Model.php')->in($path);
        } catch (\Exception $e){
            return [];
        }

        foreach ($finder as $file) {
            $ns = $this->namespace;
            if (!empty($dataDir)) {
                $ns .= '\\' . $dataDir;
            }
            if ($relativePath = $file->getRelativePath()) {
                $ns .= '\\' . strtr($relativePath, '/', '\\');
            }
            $class = $ns . '\\' . $file->getBasename('.php');

            $r = new \ReflectionClass($class);
            if ($r->isSubclassOf('exs\TcnCommonBundle\Model\\' . $model)) {
                $models[] = new $class;
            }
        }

        return $models;
    }

    /**
     * @param array $cats
     * @param string $slug
     * @return mixed|null
     */
    public function getCatFromProductSlug($cats = array(), $slug = '')
    {
        foreach ($cats as $cat) {
            if (in_array($slug, $cat->getProducts())) {
                return $cat;
            }
        }
        return null;
    }

    /**
     * If $catSlug is defined and exists, use that category
     * Else use first category having the site (i.e. getCatFromProductSlug() )
     * @param array $cats
     * @param ProductModel $site
     * @return mixed|null
     */
    public function getCatFromSite($cats = [],AbstractProductModel $site){
        if(
            null !== $site->getCategorySlug() &&
            in_array($site->getCategorySlug(),array_keys($cats))
        ) {
            return $cats[$site->getCategorySlug()];
        } else {
            return $this->getCatFromProductSlug($cats,$site->getSlug());
        }
    }
}