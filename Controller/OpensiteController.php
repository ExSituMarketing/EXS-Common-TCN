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
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function outAction($slug)
    {
        $data = $this->get('tcn.data.service')->getAllData();

        /* site exists */
        if(!isset($data['products'][$slug])){
            throw $this->createNotFoundException('Sorry not existing');
        }

        /** @var AbstractSiteModel $site */
        $site = $data['products'][$slug];
        $tourlink = $site->getTourlink();

        // redirect to the new proper tourlink
        return $this->redirect($tourlink,302);
    }
}
