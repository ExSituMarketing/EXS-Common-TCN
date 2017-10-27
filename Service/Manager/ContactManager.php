<?php

namespace exs\TcnCommonBundle\Service\Manager;

use exs\TcnCommonBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;

/**
 * Created by PhpStorm.
 * User: damiend
 * Date: 2017-09-15
 * Time: 11:09 AM
 */
class ContactManager
{
    /**
     * mailer method.
     *
     * @var object swift mailer
     */
    protected $mailer;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var string
     */
    protected $mailerTo;

    /**
     * ContactManager constructor.
     * @param FormFactory $formFactory
     * @param \Swift_Mailer $mailer
     * @param string $mailerTo
     */
    public function __construct(FormFactory $formFactory, \Swift_Mailer $mailer, $mailerTo)
    {
        $this->formFactory = $formFactory;
        $this->mailer = $mailer;
        $this->mailerTo = $mailerTo;
    }

    /**
     * @param Request $request
     *
     * @return null|FormView
     */
    public function handleForm(Request $request)
    {
        $form = $this->formFactory->create(ContactType::class);
        $form->handleRequest($request);

        // goes here on submit form
        if ($form->isValid()) {
            return $form->getData();
        }

        return $form->createView();
    }

    /**
     * send contact email to webmaster.
     *
     * @param string $htmlBody
     * @param string $textBody
     * @param string $title
     * @param string $fromEmail
     * @param string $toMail
     *
     * @return bool
     */
    public function sendContactMail($htmlBody, $textBody, $title = 'Contact Form', $fromEmail, $toEmail = null)
    {
        if (empty($htmlBody) || empty($fromEmail)) {
            return false;
        }

        if (!empty($toEmail)) {
            $this->mailerTo = $toEmail;
        }

        $message = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setSubject($title)
            ->setFrom($fromEmail)
            ->setTo($this->mailerTo)
            ->setBody($htmlBody)
            ->addPart($textBody);

        if ($this->mailer->send($message)) {
            return true;
        }

        return false;
    }
}