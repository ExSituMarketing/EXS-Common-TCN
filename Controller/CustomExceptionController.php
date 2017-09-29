<?php

namespace exs\TcnCommonBundle\Controller;

use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CustomExceptionController
 * @package AppBundle\Controller
 */
class CustomExceptionController extends Controller
{
    /**
     * @param FlattenException $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(FlattenException $exception)
    {
        $data = $this->get('tcn.data.service')->getAllData();
        $response = $this->render('ExsituTcnCommonBundle:Layout:error404.html.twig', array(
            'data' => $data,
            'error' => 'Oops! An Error Occurred'
        ));
        $response->setStatusCode($exception->getStatusCode());
        return $response;
    }
}
