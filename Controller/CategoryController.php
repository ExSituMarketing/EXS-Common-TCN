<?php

namespace Exsitu\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CategoryController
 * @package Exsitu\TcnCommonBundle\Controller
 */
class CategoryController extends Controller
{
    /**
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($slug = '')
    {
        //$data = $this->get('tcn.data.service')->getAllData();

        /** @var AccessControleService $accessControleService */
        //$accessControleService = $this->get('tcn.access_control.service');

        //category exists
        if ($accessControleService->isCategoryAvailable($slug)) {
            // show the category page
            $response = $this->render('TcnCommonBundle:Category:category.index.html.twig', array(
                //'data' => $data,
                'category' => $slug//$data['categories'][$slug]
            ));
            //$response->setSharedMaxAge(intval($this->container->getParameter('cache_length')));
        } else {
            throw $this->createNotFoundException('Sorry not existing');
        }

        return $response;
    }
}
