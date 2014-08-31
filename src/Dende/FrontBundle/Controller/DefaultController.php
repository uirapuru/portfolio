<?php

namespace Dende\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Dende\FrontBundle\Form\ContactType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="cv")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    /**
     * @Route("/projects", name="projects")
     * @Template()
     */
    public function projectsAction()
    {
        $projects = $this->getDoctrine()->getManager()->getRepository("FrontBundle:Project")->findAll();        
        
        return array(
            "projects" => $projects
        );
    }
    
    /**
     * @Route("/contact",name="contact")
     * @Method({"GET","POST"})
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactType);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    $this->get("translator")->trans("contact.thank_you_message")
                );
                
                $mailer = $this->get("mailer.contact");
                $mailer->setParameters(array(
                    "message" => $form->get("message")->getData(),
                    "email" => $form->get("email")->getData()
                ));
                $mailer->setFrom(
                    $form->get("email")->getData()
                );
                $mailer->sendMail();
            }
        }
        
        return array(
            "form" => $form->createView()
        );
    }
    
    /**
     * @Template()
     */
    public function embeddedContactAction(Request $request)
    {
        $form = $this->createForm(new ContactType);
        
        return array(
            "form" => $form->createView()
        );
    }
    
    /**
     * @Route(
     *  "/language/{locale}",
     *  name="switch_language",
     *  requirements={"locale" = "(pl|en|de|pt)"},
     *  defaults={"locale" = "pl"}
     * )
     * @Template()
     */
    public function switchLanguageAction(Request $request, $locale)
    {
        $request->setLocale($locale);
        $this->get('session')->set('_locale', $locale);
        return $this->redirect(
            $request->headers->get('referer')    
        );
    }
    
    /**
     * @Route(
     *  "/cv.html",
     *  name="download_html",
     * )
     * @Template("FrontBundle::cv.html.twig")
     */
    public function getAsHtmlAction()
    {
     return array();   
    }
    /**
     * @Route(
     *  "/cv.pdf",
     *  name="download_pdf",
     * )
     * @Template()
     */
    public function getAsPdfAction()
    {
        $html = $this->renderView('FrontBundle::cv.html.twig', array());

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="cv.pdf"'
            )
        );
    }
}
