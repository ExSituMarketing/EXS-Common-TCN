<?php

namespace exs\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class OpensiteController
 * @package exs\TcnCommonBundle\Controller
 */
class OpensiteController extends Controller
{
    /**
     * @param $slug
     * @param null $catSlug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function outAction($slug, $catSlug = null)
    {
        $data = $this->get('tcn.data.service')->getAllData();

        /* site exists */
        if(!isset($data['products'][$slug])){
            throw $this->createNotFoundException('Sorry not existing');
        }

        /** @var AbstractSiteModel $site */
        $site = $data['products'][$slug];

        $tourlinks = $site->getTourlink();
        $tourlink = $this->get('tcn.opensite.manager')->getTourlink($tourlinks, $catSlug);

        // redirect to the new proper tourlink
        $response = $this->redirect($tourlink,302);
        $response->headers->set('X-Robots-Tag', 'noindex');

        return $response;
    }
}
