<?php

namespace exs\TcnCommonBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 *
 * @package AppBundle\Controller\Frontend
 */
class ContactController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $data = $this->get('tcn.data.service')->getAllData();
        $form = $this->get('app.manager.contact')->handleForm($request);
        $success = null;

        if (is_array($form)) {
            $success = $this->get('app.manager.contact')->sendContactMail($form['message'], null, 'Contact Form', $form['email'], 'support@topvr.guide');
            $request = new Request();
            $form = $this->get('app.manager.contact')->handleForm($request);
        }

        return $this->render('ExsituTcnCommonBundle:Contact:contact.index.html.twig', [
            'form' => $form,
            'data' => $data,
            'success' => $success,
            'pageTitle' => 'Contact Us',
            'robotValue' => 'noindex, follow'
        ]);
    }
}