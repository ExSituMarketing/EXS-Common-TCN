<?php

namespace exs\TcnCommonBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
            $site = $data['home']->getName();
            $success = $this->get('app.manager.contact')->sendContactMail($form['message'], null, $site . ' Contact Form', $form['email']);
            if ($success) {
                return $this->redirectToRoute("exsitu_tcn_common_contact_success");
            }
        }

        return $this->render('ExsituTcnCommonBundle:Contact:contact.index.html.twig', [
            'form' => $form,
            'data' => $data,
            'success' => $success,
            'pageTitle' => 'Contact Us',
            'pageClass' => 'contact-page',
            'robotValue' => 'noindex, follow',
            'canonical' => $this->get('router')->generate('exsitu_tcn_common_contact_form', array(), UrlGeneratorInterface::ABSOLUTE_URL)
        ]);
    }

    public function successAction()
    {
        $data = $this->get('tcn.data.service')->getAllData();

        return $this->render('ExsituTcnCommonBundle:Contact:contact.index.html.twig', [
            'data' => $data,
            'success' => true,
            'pageTitle' => 'Contact Us',
            'pageClass' => 'contact-success-page',
            'robotValue' => 'noindex, follow',
            'canonical' => $this->get('router')->generate('exsitu_tcn_common_contact_success', array(), UrlGeneratorInterface::ABSOLUTE_URL)
        ]);
    }
}