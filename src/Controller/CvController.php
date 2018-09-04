<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Contact;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CvController extends AbstractController
{
    /**
     * @Route(name="cv_index", path="/")
     */
    public function indexAction()
    {
        return $this->render('cv/index.html.twig');
    }

    /**
     *
     * @Route(name="send_mail", path="/sendMail")
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function createAction(\Swift_Mailer $mailer)
    {

            # set form data   
            $contact = new Contact();
            $contact->setName($_POST['name']);
            $contact->setEmail($_POST['Subject']);
            $contact->setSubject($_POST['_replyto']);
            $contact->setMessage($_POST['message']);

            $sn = $this->getDoctrine()->getManager();
            $sn->persist($contact);
            $sn->flush();

            $message = (new \Swift_Message('Hello Email'))
                ->setTo('sahbi.berriri@gmail.com')
                ->setTo('aminebenturkia@gmail.com')
                ->setBody('<h1>merci</h1>',
                    'text/html'
                );

            $mailer->send($message);

            // cc tu es la ?" ah lo5or dsl kont m3a client almani :p ok taba3 ay ok ?ok
        return $this->render('cv/index.html.twig');
    }

}






