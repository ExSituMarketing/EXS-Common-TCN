<?php

namespace exs\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class SearchController
 * @package exs\TcnCommonBundle\Controller
 */
class SearchController extends Controller
{
    /**
     * @return Response
     */
    public function allProductsAction($hash = '')
    {
        $data = $this->get('tcn.data.service')->getAllData();

        $response = new Response();
        $response->setContent(
            'var data=' . \json_encode($this->formatdataForSearch($data)) . ';'
        );
        $date = new \DateTime();
        $date->modify('+14 days');
        $response->setExpires($date);
        return $response;
    }

    /**
     * Search result page
     *
     * @param $query
     * @return Response
     *
     * @Route("/search/", defaults={"query" = null})
     * @Route("/search/{query}", defaults={"query" = null})
     */
    public function indexAction($query)
    {
        $data = $this->get('tcn.data.service')->getAllData();
        $toLowerQuery = strtolower($query);

        if (!empty($data)) {
            $results = array_filter($data['products'], function($value) use ($toLowerQuery) {
                if (strpos($value->getSlug(), $toLowerQuery) !== false || strpos(strtolower($value->getName()), $toLowerQuery) !== false) {
                    return $value->getSlug();
                }
            });

            $results = array_keys($results);

            if (count($results) < 1) {
                $results = null;
            }

            // display the review
            $response = $this->render('ExsituTcnCommonBundle:Search:search.index.html.twig', array(
                'data' => $data,
                'searchResults' => $results,
                'searchTerm' => $query,
                'products' => $data['home']->getTopProducts(),
                'pageClass' => 'search-page',
                'robotValue' => 'noindex, follow',
                'canonical' => $this->get('router')->generate('exsitu_tcn_common_home', array(), UrlGeneratorInterface::ABSOLUTE_URL)
            ));
        } else {
            throw $this->createNotFoundException('Sorry the page does not exist');
        }
        return $response;
    }

    public function formatdataForSearch($data = array())
    {
        $formatted = [];
        foreach ($data['products'] as $product) {
            if($product->getName()){
                //site has a review and a category
//                if (strlen($product->getOverview()) > 0 && $product->getCategory()) {
//                    // generate review url
                // TODO: make sure it's https
//                    $link = $this->generateUrl('exsitu_tcn_common_review',
//                        [
//                            'categorySlug' => $product->getCategory()->getSlug(),
//                            'reviewSlug' => $product->getSlug()
//                        ],
//                        true
//                    );
//                } else {
//                    // else generate tourlink url
//                    $link = $product->getTourLink();
//                }
                $link = $product->getTourLink();

                $formatted[] = [
                    'name' => $product->getName(),
                    'link' => $link,
                    'slug' => $product->getSlug(),
                ];
            }
        }
        return $formatted;
    }
}
