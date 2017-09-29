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
        /** @var AccessControleService $accessControleService */
        //$accessControleService = $this->get('tcn.access_control.service');
        //category exists
        //if ($accessControleService->isCategoryAvailable($slug)) {
        // show the category page
        $response = $this->render('ExsituTcnCommonBundle:Category:category.index.html.twig', array(
            'data' => $data,
            'catSlug' => $data['categories'][$slug]->getSlug(),
            'products' => $data['categories'][$slug]->getProducts()
        ));
        //$response->setSharedMaxAge(intval($this->container->getParameter('cache_length')));
//        } else {
//            throw $this->createNotFoundException('Sorry not existing');
//        }
        return $response;
    }
}
