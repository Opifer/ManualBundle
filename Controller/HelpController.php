<?php

namespace Opifer\ManualBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HelpController
 *
 * This is the controller responsible for the help functionality
 * Please note that all routes defined in this bundle are prefixed by /admin
 * This is set in Resources/config/routing.yml
 *
 * @package Opifer\ManualBundle\Controller
 */
class HelpController extends Controller
{
    /**
     * @Route("/help", name="opifer.manual.help.index", options={"expose"=true})
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function helpAction(Request $request)
    {
        $catRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Category');
        $categories = $catRepo->findAll();

        return $this->render('OpiferManualBundle:Help:index.html.twig', [
            'categories'  => $categories,
        ]);
    }

    /**
     * @Route("/help/search", name="opifer.manual.help.search", options={"expose"=true})
     * @Method({"POST"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction()
    {
        $request = $this->get('request');
        $searchQuery    = $request->request->get('searchForm');

        $response = array ("responseCode" => 200, "search-query" => $searchQuery);
        $response = json_encode($response);//json encode the array
        return new Response($response, 200, array ('Content-Type' => 'application/json'));//make sure it has the correct content type
    }

    /**
     * @Route("/help/{slug}", name="opifer.manual.help.show", options={"expose"=true})
     *
     * @param string $slug the slug use to get the article
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticleAction($slug)
    {
        $articleRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Article');
        $article = $articleRepo->findOneBySlug($slug);

        return $this->render('OpiferManualBundle:Help:showArticle.html.twig', [
            'article' => $article,
        ]);
    }
}