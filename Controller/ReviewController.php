<?php

namespace exs\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
                'review' => $data['products'][$reviewSlug]
            ));
        } else {
            throw $this->createNotFoundException('Sorry the page does not exist');
        }
        return $response;
    }
}
