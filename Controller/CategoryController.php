<?php

namespace exs\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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

        if (array_key_exists($slug, $data['categories'])) {
            // show the category page
            $response = $this->render('ExsituTcnCommonBundle:Category:category.index.html.twig', array(
                'data' => $data,
                'catSlug' => $data['categories'][$slug]->getSlug(),
                'products' => $data['categories'][$slug]->getProducts(),
                'canonical' => $this->get('router')->generate('exsitu_tcn_common_category', array('slug' => $data['categories'][$slug]->getSlug()), UrlGeneratorInterface::ABSOLUTE_URL)
            ));
        } else {
            throw $this->createNotFoundException('Sorry not existing');
        }

        return $response;
    }
}
