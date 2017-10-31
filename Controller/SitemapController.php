<?php

namespace exs\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class SitemapController
 * @package exs\TcnCommonBundle\Controller
 */
class SitemapController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sitemapAction()
    {
        $data = $this->get('tcn.data.service')->getAllData();

        if (!empty($data)) {
            $response = $this->render('@ExsituTcnCommon/Sitemap/sitemap.html.twig', array(
                'data' => $data,
                'robotValue' => 'noindex, follow',
                'pageClass' => 'topvr_tcn_sitemap',
                'canonical' => $this->get('router')->generate('topvr_tcn_sitemap', array(), UrlGeneratorInterface::ABSOLUTE_URL)
            ));

        } else {
            throw $this->createNotFoundException('Sorry the page does not exist');
        }
        return $response;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function xmlSitemapAction()
    {
        $data = $this->get('tcn.data.service')->getAllData();

        if (!empty($data)) {
            $response = $this->render('@ExsituTcnCommon/Sitemap/sitemap.xml.twig', array(
                'data' => $data,
            ));
            $response->headers->set('Content-Type', 'application/xml; charset=utf-8');

        } else {
            throw $this->createNotFoundException('Sorry the page does not exist');
        }
        return $response;
    }
}
