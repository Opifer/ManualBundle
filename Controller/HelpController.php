<?php

namespace Opifer\ManualBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class HelpController
 *
 * This is the controller responsible for the help functionality
 * Please note that all routes defined in this bundle are prefixed by /admin
 * This is set in Resources/config/routing.yml
 *
 * The prefix route used by all the actions below:
 * @Route("/admin/help")
 *
 * @package Opifer\ManualBundle\Controller
 */
class HelpController extends Controller
{
    /**
     * @Route("/", name="opifer.manual.help.index", options={"expose"=true})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function helpAction()
    {
        $catRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Category');
        $categories = $catRepo->findAll();

        return $this->render('OpiferManualBundle:Help:index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * Gets the articles based on a query which is passed from search.js
     *
     * @Route("/search/{query}", name="opifer.manual.help.search", options={"expose"=true})
     * @Method({"GET"})
     *
     * @param string                                    $query The query gotten from the search box
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function searchAction($query ,Request $request)
    {
        $repo = $this->getDoctrine()->getRepository("OpiferManualBundle:Article");
        $result = $repo->getSearchedArticles($query);

        return new JsonResponse($result);
    }

    /**
     * @Route("/search", name="opifer.manual.help.search_all", options={"expose"=true})
     * @Method({"GET"})
     */
    public function searchAllAction()
    {
        $artRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Article');
        $serializer = $this->container->get('jms_serializer');

        /** @noinspection PhpUnusedLocalVariableInspection */
        $searchResult = $artRepo->findAll();
        $searchResult = $serializer->serialize($searchResult, 'json');
        $response = [$searchResult];
        $responseCode = 200;

        return new Response($response, $responseCode, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/show/{slug}", name="opifer.manual.help.show", options={"expose"=true})
     *
     * @param string $slug the slug use to get the article
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticleAction($slug)
    {
        $articleRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Article');
        $article = $articleRepo->findOneBySlug($slug);

        if(empty($article))
        {
            throw $this->createNotFoundException("No article found with slug: ". $slug);
        }

        return $this->render('OpiferManualBundle:Help:showArticle.html.twig', [
            'article' => $article,
        ]);
    }
}