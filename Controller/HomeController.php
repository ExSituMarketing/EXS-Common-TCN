<?php

namespace exs\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @param string $lang
     * @return mixed
     */
    public function indexAction()
    {
        $data = $this->get('tcn.data.service')->getAllData();

        // TODO: get information about the sites for data

        // show default page with slug (slug defaulted to '')
        $response = $this->render('ExsituTcnCommonBundle:Home:home.index.html.twig', array(
            'data' => $data,
            'canonical' => $this->get('router')->generate('exsitu_tcn_common_home', array(), UrlGeneratorInterface::ABSOLUTE_URL)
        ));
        //$response->setSharedMaxAge(intval($this->container->getParameter('cache_length')));
        return $response;
    }
}
