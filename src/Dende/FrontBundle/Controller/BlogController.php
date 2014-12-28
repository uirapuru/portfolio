<?php

namespace Dende\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Dende\FrontBundle\Form\ContactType;

/**
 * Class BlogController
 * @package Dende\FrontBundle\Controller
 * @Route("/blog")
 */
class BlogController extends Controller
{
    /**
     * @Route("/index", name="blog")
     * @Template()
     */
    public function indexAction()
    {
        $articles = $this->getDoctrine()->getRepository("")->findAll();
        return [
            "articles" => $articles
        ];
    }
}
