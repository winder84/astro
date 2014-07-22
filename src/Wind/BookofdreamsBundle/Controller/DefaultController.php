<?php

namespace Wind\BookofdreamsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WindBookofdreamsBundle:Default:index.html.twig');
    }
}
