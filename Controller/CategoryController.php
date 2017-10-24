<?php

namespace exs\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CategoryController
 * @package exs\TcnCommonBundle\Controller
 */
class CategoryController extends Controller
{
    /**
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($slug = '')
    {
        $data = $this->get('tcn.data.service')->getAllData();

        // show the category page
        $response = $this->render('ExsituTcnCommonBundle:Category:category.index.html.twig', array(
            'data' => $data,
            'catSlug' => $data['categories'][$slug]->getSlug(),
            'products' => $data['categories'][$slug]->getProducts()
        ));

        return $response;
    }
}
