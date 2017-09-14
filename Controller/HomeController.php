<?php

namespace Exsitu\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @param string $lang
     * @return mixed
     */
    public function indexAction()
    {
        //$data = $this->get('myfav.data.service')->getAllData();
        // lang slug is not empty and does not exists
//        if($lang != '' && !isset($data['languages'][$lang])){
//            // 404
//            throw new NotFoundHttpException();
//        }
        // show default page with slug (slug defaulted to '')
        $response = $this->render('ExsituTcnCommonBundle:Default:default.index.html.twig', array(
            'lang' => 'BLAJ'//$lang,
            //'data' => $data
        ));
        //$response->setSharedMaxAge(intval($this->container->getParameter('cache_length')));
        return $response;
    }
}
