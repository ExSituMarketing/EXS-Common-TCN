<?php

namespace Exsitu\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ReviewController
 * @package Exsitu\TcnCommonBundle\Controller
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
        $data = $this->get('myfav.data.service')->getAllData();
        die;
//        /** @var AccessControlService $accessControleService */
//        $accessControleService = $this->get('myfav.access_control.service');

//        if ($accessControleService->isReviewAvailable($categorySlug,$reviewSlug)) {
            // display the review
            $response = $this->render('ExsituTcnCommonBundle:Review:review.index.html.twig', array(
//                'data' => $data,
                'category' => $categorySlug,//$data['categories'][$categorySlug],
                'review' => $reviewSlug//$data['sites'][$reviewSlug]
            ));
//            $response->setSharedMaxAge(intval($this->container->getParameter('cache_length')));
//        } elseif ($accessControleService->isNewReviewAvailable($reviewSlug)){
//            //then redirect to the new slug
//            $response = $this->redirect(
//                $this->generateUrl(
//                    'exsitu_myfav_common_review',
//                    [
//                        'categorySlug' => $data['sites'][$data['sites'][$reviewSlug]->getNewSlug()]->getCategory()->getSlug(),
//                        'reviewSlug' => $data['sites'][$reviewSlug]->getNewSlug()
//                    ]),
//                301
//            );
//        } elseif($accessControleService->isLanguageAvailable($categorySlug)){
//            // the category slug is a language slug, then 404 with language error (no reviews on languages page)
//            $response = $this->render('ExsituMyfavCommonBundle:Default:index.html.twig', array(
//                'data' => $data,
//                'error' => 'Oops! An Error Occurred',
//                'lang' => $categorySlug,
//            ));
//            $response->setStatusCode(404);
//            return $response;
//        } else {
//            throw $this->createNotFoundException('Sorry not existing');
//        }
        return $response;
    }
}
