<?php

namespace exs\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ReviewController
 * @package exs\TcnCommonBundle\Controller
 */
class ReviewController extends Controller
{
    /**
     * @param string $categorySlug
     * @param string $reviewSlug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($categorySlug = '', $reviewSlug = '')
    {
        $data = $this->get('tcn.data.service')->getAllData();
        if (!empty($data)) {
            // display the review
            $response = $this->render('ExsituTcnCommonBundle:Review:review.index.html.twig', array(
                'data' => $data,
                'category' => $data['categories'][$categorySlug],
                'review' => $data['products'][$reviewSlug],
                'canonical' => $this->get('router')->generate('exsitu_tcn_common_review', array(
                    'categorySlug' => $data['categories'][$categorySlug]->getSlug(),
                    'reviewSlug' => $data['products'][$reviewSlug]['slug']
                ), UrlGeneratorInterface::ABSOLUTE_URL)
            ));
        } else {
            throw $this->createNotFoundException('Sorry the page does not exist');
        }
        return $response;
    }
}
